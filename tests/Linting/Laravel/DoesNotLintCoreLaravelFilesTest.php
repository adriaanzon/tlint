<?php

use PHPUnit\Framework\TestCase;
use Symfony\Component\Console\Application;
use Symfony\Component\Console\Tester\CommandTester;
use Tighten\Commands\LintCommand;

class DoesNotLintCoreLaravelFilesTest extends TestCase
{
    /** @test */
    function does_not_lint_app_Http_Middleware_RedirectIfAuthenticated()
    {
        $application = new Application;
        $command = new LintCommand(__DIR__ . '/LaravelApp');
        $application->add($command);
        $commandTester = new CommandTester($command);

        $commandTester->execute([
            'command'  => $command->getName(),
            'file or directory' => 'app/Http/Middleware/RedirectIfAuthenticated.php',
        ]);

        $this->assertEquals(0, $commandTester->getStatusCode());
    }

    /** @test */
    function does_not_lint_app_Exceptions_Handler()
    {
        $application = new Application;
        $command = new LintCommand(__DIR__ . '/LaravelApp');
        $application->add($command);
        $commandTester = new CommandTester($command);

        $commandTester->execute([
            'command'  => $command->getName(),
            'file or directory' => 'app/Exceptions/Handler.php',
        ]);

        $this->assertEquals(0, $commandTester->getStatusCode());
    }

    /** @test */
    function does_not_lint_app_Http_Kernel()
    {
        $application = new Application;
        $command = new LintCommand(__DIR__ . '/LaravelApp');
        $application->add($command);
        $commandTester = new CommandTester($command);

        $commandTester->execute([
            'command'  => $command->getName(),
            'file or directory' => 'app/Http/Kernel.php',
        ]);

        $this->assertEquals(0, $commandTester->getStatusCode());
    }

    /** @test */
    function does_not_lint_auth_scaffolding()
    {
        $application = new Application;
        $command = new LintCommand(__DIR__ . '/LaravelApp');
        $application->add($command);
        $commandTester = new CommandTester($command);

        $commandTester->execute([
            'command'  => $command->getName(),
            'file or directory' => 'app/Http/Controllers/Auth',
        ]);

        $this->assertEquals(0, $commandTester->getStatusCode());
    }

    /** @test */
    function does_not_lint_server_php()
    {
        $application = new Application;
        $command = new LintCommand(__DIR__ . '/LaravelApp');
        $application->add($command);
        $commandTester = new CommandTester($command);

        $commandTester->execute([
            'command'  => $command->getName(),
            'file or directory' => 'server.php',
        ]);

        $this->assertEquals(0, $commandTester->getStatusCode());
    }
}
