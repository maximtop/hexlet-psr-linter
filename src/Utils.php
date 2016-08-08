<?php

namespace HexletPsrLinter;

function getFilesByPath($path)
{
    $files = [];

    if (is_dir($path)) {
        $iterator = new \RecursiveIteratorIterator(new \RecursiveDirectoryIterator($path));
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

function printReport($path)
{
    $files = getFilesByPath($path);

    foreach ($files as $filename) {
        $fileContent = file_get_contents($filename);
        $errorList = lint($fileContent);
        $climate = new \League\CLImate\CLImate;
        $climate->out($filename);

        if (count($errorList) > 0) {
            $climate->columns($errorList);
        } else {
            $climate->out("<green>No errors</green>");
        }
        $climate->out("\n");
    }
    return 1;
}
