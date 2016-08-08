<?php

namespace HexletPsrLinter;

use PhpParser\Node;
use PhpParser\NodeVisitorAbstract;
use PhpParser\Node\Stmt\ClassMethod;
use PhpParser\Node\Stmt\Function_;
use PhpParser\Node\Expr\Variable;

class Visitor extends NodeVisitorAbstract
{
    private $errors = [];

    public function leaveNode(Node $node)
    {
        if ($node instanceof ClassMethod && checkFunctionName($node->name) != true) {
            $errorString = "Method name is not in camel caps format";
            $this->errors[] = [$node->getLine(), "<red>error</red>", $errorString, $node->name];
        } elseif ($node instanceof Function_ && checkFunctionName($node->name) != true) {
            $errorString = "Function name is not in camel caps format";
            $this->errors[] = [$node->getLine(), "<red>error</red>", $errorString, $node->name];
        } elseif ($node instanceof Variable && checkVariableName($node->name) != true) {
            $errorString = "Variable name is not in camel caps format";
            $this->errors[] = [$node->getLine(), "<yellow>warning</yellow>", $errorString, $node->name];
        }
    }



    public function getErrors()
    {
        return $this->errors;
    }
}
