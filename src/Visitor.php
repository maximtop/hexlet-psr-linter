<?php

namespace HexletPsrLinter;

use PhpParser\Node;
use PhpParser\NodeVisitorAbstract;
use PhpParser\Node\Stmt\ClassMethod;
use PhpParser\Node\Stmt\Function_;

class Visitor extends NodeVisitorAbstract
{
    private $errors = [];

    public function leaveNode(Node $node)
    {
        //think how to check here variables names
        if ($node instanceof ClassMethod && checkFunctionName($node->name) != true) {
            $errorString = "Method name is not in camel caps format";
            $this->errors[] = [$node->getLine(), "<red>error</red>", $errorString, $node->name];
        } elseif ($node instanceof Function_ && checkFunctionName($node->name) != true) {
            $errorString = "Function name is not in camel caps format";
            $this->errors[] = [$node->getLine(), "<red>error</red>", $errorString, $node->name];
        }
    }



    public function getErrors()
    {
        if (count($this->errors) <= 0) {
            return "There is no errors in functions or methods names";
        }
        return $this->errors;
    }
}
