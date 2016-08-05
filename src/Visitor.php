<?php

namespace HexletPsrLinter;

use PhpParser\Node;
use PhpParser\NodeVisitorAbstract;
use League\CLImate\CLImate;

class Visitor extends NodeVisitorAbstract
{
    private $listOfFunctionsNames = [];
    private $erros;

    public function leaveNode(Node $node)
    {
        $nodeClass = get_class($node);
        if ($nodeClass == "PhpParser\\Node\\Stmt\\ClassMethod" && checkFunctionName($node->name) != true) {
            $error_string = "Method name is not in camel caps format";
            $this->listOfFunctionsNames[] = [$node->getLine(), "<red>error</red>", $error_string, $node->name];
        } elseif ($nodeClass == "PhpParser\\Node\\Stmt\\Function_" && checkFunctionName($node->name) != true) {
            $error_string = "Function name is not in camel caps format";
            $this->listOfFunctionsNames[] = [$node->getLine(), "<red>error</red>", $error_string, $node->name];
        }
    }

    public function getFunctionsNames()
    {
        return $this->listOfFunctionsNames;
    }

    public function getErrorString()
    {
        $error_list = $this->getFunctionsNames();
        $string = array_reduce($error_list, function ($acc, $item) {
            $acc .= $item[0] . "\t" . "error" . "\t" . $item[2] . "\t" . $item[1] . PHP_EOL;
            return $acc;
        }, "");
        return $string;
    }
}
