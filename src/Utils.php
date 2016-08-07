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

function printReport($path)
{
    $files = getFilesByPath($path);

    foreach ($files as $filename) {
        $fileContent = file_get_contents($filename);
        $errorList = getFunctions($fileContent);
        $climate = new \League\CLImate\CLImate;
        $climate->out($filename);

        if (is_array($errorList)) {
            $climate->columns($errorList);
        } else {
            $climate->out($errorList);
        }
        $climate->out("\n");
    }
    return 1;
}
