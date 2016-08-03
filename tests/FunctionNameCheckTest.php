<?php

namespace HexletPsrLinter;

use function HexletPsrLinter\checkFunctionName;

class FunctionNameCheckTest extends \PHPUnit_Framework_TestCase
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
}
