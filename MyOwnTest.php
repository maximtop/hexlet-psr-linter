<?php

class MyOwnTest
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

$name = 'maxim';
echo $name;
