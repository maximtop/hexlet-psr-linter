<?php


namespace HexletPsrLinter;

use org\bovigo\vfs\vfsStream;

class UtilsTest extends \PHPUnit_Framework_TestCase
{

    public function testGetFilesByPath()
    {
        vfsStream::setup();
        $structure = [
            'folder1' => [
                'folder2' => [
                    'test1.php' => '',
                    'test2.php' => '',
                    'test5.txt' => '',
                ],
                'test3.php' => '',
                'test4.css' => '',
            ]
        ];
        $root = vfsStream::create($structure);
        $rootPath = vfsStream::url($root->getName());
        $expected = getFilesByPath($rootPath);
        $this->assertEquals(
            $expected[0],
            'vfs://root' . DIRECTORY_SEPARATOR .
            'folder1' . DIRECTORY_SEPARATOR .
            'folder2' . DIRECTORY_SEPARATOR .
            'test1.php'
        );
        $this->assertEquals(
            $expected[1],
            'vfs://root' . DIRECTORY_SEPARATOR .
            'folder1' . DIRECTORY_SEPARATOR .
            'folder2' . DIRECTORY_SEPARATOR .
            'test2.php'
        );
        $this->assertEquals(
            $expected[2],
            'vfs://root' . DIRECTORY_SEPARATOR .
            'folder1' . DIRECTORY_SEPARATOR .
            'test3.php'
        );
    }
}
