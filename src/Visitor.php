<?php

namespace HexletPsrLinter;

use PhpParser\Node;
use PhpParser\NodeVisitorAbstract;

class Visitor extends NodeVisitorAbstract
{
    private $listOfFunctionsNames = [];

    public function leaveNode(Node $node)
    {
        if ($node instanceof PhpParser\Node\Stmt\ClassMethod) {
            $this->listOfFunctionsNames[] = $node->name;
        }
    }

    public function getFunctionsNames()
    {
        return $this->listOfFunctionsNames;
    }

}