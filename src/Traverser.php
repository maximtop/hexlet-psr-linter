<?php

namespace HexletPsrLinter;

use PhpParser\NodeTraverser;
use PhpParser\ParserFactory;

function getTree($content)
{
    $parser = (new ParserFactory)->create(ParserFactory::PREFER_PHP7);
    $stmts = $parser->parse($content);
    return $stmts;
}

function getFunctions($content)
{
    $tree = getTree($content);
    $traverser = new NodeTraverser;
    $visitor = new Visitor;
    $traverser->addVisitor($visitor);
    $stmts = $traverser->traverse($tree);
    return $visitor->getFunctionsNames();
}
