<?php

namespace HexletPsrLinter;

function checkFunctionName($name)
{
    return \PHP_CodeSniffer::isCamelCaps($name);
}