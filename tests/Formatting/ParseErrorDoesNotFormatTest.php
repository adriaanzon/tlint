<?php

namespace tests\Formatting;

use PHPUnit\Framework\TestCase;
use Symfony\Component\Console\Application;
use Symfony\Component\Console\Tester\CommandTester;
use Tighten\Commands\FormatCommand;

class ParseErrorDoesNotFormatTest extends TestCase
{
    /** @test */
    function gracefully_handles_parse_error()
    {
        $application = new Application;

        $command = new FormatCommand;
        $application->add($command);
        $commandTester = new CommandTester($command);

        $file = <<<file
<?php

namespace App;

class Thing
{
    const OK

    retunr 1
}
file;

        $filePath = tempnam(sys_get_temp_dir(), 'test');

        file_put_contents($filePath, $file);

        $commandTester->execute([
            'command'  => $command->getName(),
            'file or directory' => $filePath,
        ]);

        $this->assertContains("unexpected T_STRING, expecting '='", $commandTester->getDisplay());
        $this->assertEquals(1, $commandTester->getStatusCode());
    }
}
