<?php

namespace HexletPsrLinter;

use PhpParser\Node\Expr\Variable;

function checkVariableNames($node)
{
    $error = [];
    if ($node instanceof Variable && \PHP_CodeSniffer::isCamelCaps($node->name) != true) {
        $errorString = "Variable name is not in camel caps format";
        $error = [$node->getLine(), "<yellow>warning</yellow>", $errorString, $node->name];
    }
    return $error;
}