<?php

namespace Tighten\Linters;

use PhpParser\Node;
use PhpParser\NodeTraverser;
use PhpParser\NodeVisitor\FindingVisitor;
use PhpParser\Node\Expr\FuncCall;
use PhpParser\Parser;
use Tighten\BaseLinter;

class NoDd extends BaseLinter
{
    public const description = 'There should be no calls to `dd()`';

    public function lint(Parser $parser)
    {
        $traverser = new NodeTraverser;

        $visitor = new FindingVisitor(function (Node $node) {
            return $node instanceof FuncCall && ! empty($node->name->parts) && $node->name->parts[0] === 'dd';
        });

        $traverser->addVisitor($visitor);

        $traverser->traverse($parser->parse($this->code));

        return $visitor->getFoundNodes();
    }
}
