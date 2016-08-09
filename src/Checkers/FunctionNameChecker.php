<?php

namespace HexletPsrLinter;

use PhpParser\Node\Stmt\ClassMethod;
use PhpParser\Node\Stmt\Function_;

function checkFunctionNames($node)
{
    $error = [];
    if ($node instanceof ClassMethod && \PHP_CodeSniffer::isCamelCaps($node->name) != true) {
        $errorString = "Method name is not in camel caps format";
        $error = [$node->getLine(), "<red>error</red>", $errorString, $node->name];
    } elseif ($node instanceof Function_ && \PHP_CodeSniffer::isCamelCaps($node->name) != true) {
        $errorString = "Function name is not in camel caps format";
        $error = [$node->getLine(), "<red>error</red>", $errorString, $node->name];
    }
    return $error;
}