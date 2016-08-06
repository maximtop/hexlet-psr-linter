<?php

namespace HexletPsrLinter;

function getFilesByPath($path)
{
    $files = [];
    $iterator = new \RecursiveIteratorIterator(new \RecursiveDirectoryIterator($path));
    if (is_dir($path)) {
        foreach ($iterator as $item) {
            if ($item->isFile() && $item->getExtension() == 'php') {
                $files[] = $item->getPathname();
            }
        }
    } elseif (is_file($path)) {
        $files[] = $path;
    }
    return $files;
}

function returnResult($path)
{
    $files = getFilesByPath($path);
    foreach ($files as $filename) {
        $fileContent = file_get_contents($filename);
        $climate = new \League\CLImate\CLImate;
        $climate->out($filename);
        if (is_array(getFunctions($fileContent))) {
            $climate->columns(getFunctions($fileContent));
        } else {
            $climate->out(getFunctions($fileContent));
        }
        $climate->out("\n");
    }
}
