<?php

namespace HexletPsrLinter;

use PhpParser\Node;
use PhpParser\NodeVisitorAbstract;

class Visitor extends NodeVisitorAbstract
{
    private $errors = [];

    public function leaveNode(Node $node)
    {
        $nodeError = checkFunctionNames($node);
        if (count($nodeError) > 0) {
            $this->errors[] = $nodeError;
        }

        $nodeError = checkVariableNames($node);
        if (count($nodeError) > 0) {
            $this->errors[] = $nodeError;
        }
    }



    public function getErrors()
    {
        return $this->errors;
    }
}
