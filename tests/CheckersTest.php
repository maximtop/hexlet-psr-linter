<?php

namespace HexletPsrLinter;

use PhpParser\Node\Stmt\Function_;
use PhpParser\Node\Expr\Variable;

class CheckersTest extends \PHPUnit_Framework_TestCase
{

    public function testCheckFunctionName()
    {

        $testArray = [
            'CamelCase' => ["-1", "<red>error</red>", "Function name is not in camel caps format", 'CamelCase'],
            'camelCCase' => ["-1", "<red>error</red>", "Function name is not in camel caps format", 'camelCCase'],
            'camel_case' => ["-1", "<red>error</red>", "Function name is not in camel caps format", 'camel_case'],
            'Camelcase' => ["-1", "<red>error</red>", "Function name is not in camel caps format", 'Camelcase'],
        ];
        foreach ($testArray as $key => $value) {
            $this->assertEquals(checkFunctionNames(new Function_($key)), $value, $key);
        }
    }

    public function testCheckVariableName()
    {

        $testArray = [
            "CamelCase" => ["-1", "<yellow>warning</yellow>", "Variable name is not in camel caps format", 'CamelCase'],
            "camelCCase" => [
                "-1",
                "<yellow>warning</yellow>",
                "Variable name is not in camel caps format",
                'camelCCase'
            ],
            "camel_case" => [
                "-1",
                "<yellow>warning</yellow>",
                "Variable name is not in camel caps format",
                'camel_case'
            ],
            "Camelcase" => ["-1", "<yellow>warning</yellow>", "Variable name is not in camel caps format", 'Camelcase'],
        ];
        foreach ($testArray as $key => $value) {
            $this->assertEquals(checkVariableNames(new Variable($key)), $value, $key);
        }
    }
}
