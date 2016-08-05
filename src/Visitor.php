<?php

namespace HexletPsrLinter;

use PhpParser\Node;
use PhpParser\NodeVisitorAbstract;

class Visitor extends NodeVisitorAbstract
{
    private $errorFunctions = [];

    public function leaveNode(Node $node)
    {
        $nodeClass = get_class($node);
        if ($nodeClass == "PhpParser\\Node\\Stmt\\ClassMethod" && checkFunctionName($node->name) != true) {
            $errorString = "Method name is not in camel caps format";
            $this->errorFunctions[] = [$node->getLine(), "<red>error</red>", $errorString, $node->name];
        } elseif ($nodeClass == "PhpParser\\Node\\Stmt\\Function_" && checkFunctionName($node->name) != true) {
            $errorString = "Function name is not in camel caps format";
            $this->errorFunctions[] = [$node->getLine(), "<red>error</red>", $errorString, $node->name];
        }
    }

    public function getErrorFunctions()
    {
        return $this->errorFunctions;
    }
}
