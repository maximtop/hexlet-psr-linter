<?php

namespace HexletPsrLinter;

class CheckersTest extends \PHPUnit_Framework_TestCase
{

    public function testCheckFunctionName()
    {
        $testArray = [
            'camelcase' => true,
            'camelCase' => true,
            'camelCaseCase' => true,
            'CamelCase' => false,
            'camelCCase' => false,
            'camel_case' => false,
            'Camelcase' => false
        ];
        foreach ($testArray as $key => $value) {
            $this->assertEquals(checkFunctionName($key), $value, $key);
        }
    }

    public function testCheckVariableName()
    {
        $testArray = [
            'camelcase' => true,
            'camelCase' => true,
            'camelCaseCase' => true,
            'CamelCase' => false,
            'camelCCase' => false,
            'camel_case' => false,
            'Camelcase' => false
        ];
        foreach ($testArray as $key => $value) {
            $this->assertEquals(checkVariableName($key), $value, $key);
        }
    }
}
