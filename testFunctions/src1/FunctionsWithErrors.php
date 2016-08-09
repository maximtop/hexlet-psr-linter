<?php

class FunctionsWithErrors
{

    public function camelCase()
    {
        return true;

    }

    public function camel_first_case()
    {
        return false;
    }

    public function camelSecondCase()
    {
        return true;

    }

    public function camelTHIRDCase()
    {

        return false;

    }
}

function camelCase() {
    return true;
}

function camel_Case() {
    return false;
}

$name = 'maxim';
echo $name;

$testVARAIBLE = 'test';
