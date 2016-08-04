<?php

namespace HexletPsrLinter;

use PhpParser\Node;
use PhpParser\NodeVisitorAbstract;

class Visitor extends NodeVisitorAbstract
{
    private $listOfFunctionsNames = [];
    private $erros;

    public function leaveNode(Node $node)
    {
        $nodeClass = get_class($node);
        if ($nodeClass == "PhpParser\\Node\\Stmt\\ClassMethod" && checkFunctionName($node->name) != true) {
            $this->listOfFunctionsNames[] = [$node->name, "Method name is not in camel caps format"];
        } elseif ($nodeClass == "PhpParser\\Node\\Stmt\\Function_" && checkFunctionName($node->name) != true) {
            $this->listOfFunctionsNames[] = [$node->name, "Function name is not in camel caps format"];
        }
    }

    public function getFunctionsNames()
    {
        return $this->listOfFunctionsNames;
    }

    public function getErrorString()
    {
        $error_list = $this->getFunctionsNames();
        return array_reduce($error_list, function($acc, $item) {
            $acc .= $item[1] . "\t" . $item[0] . PHP_EOL;
            return $acc;
        }, '');

    }
}
