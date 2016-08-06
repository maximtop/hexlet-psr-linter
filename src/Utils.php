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
