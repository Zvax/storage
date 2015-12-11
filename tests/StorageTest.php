<?php

class StorageTest extends \Tests\BaseStorageCase
{
    public function testInstantiates()
    {
        $loader = new \Storage\FileLoader(__DIR__);
        $this->assertInstanceOf('Storage\Loader',$loader);
    }
    public function testWithoutTrailingSlash()
    {
        $loader = new \Storage\FileLoader(__DIR__.'/test_files');
        $string = $loader->getAsString('dummy.txt');
        $this->assertInternalType('string',$string);
    }
    public function testLoad()
    {
        $loader = new \Storage\FileLoader(__DIR__.'/test_files/');
        $string = $loader->getAsString('dummy.txt');
        $this->assertInternalType('string',$string);
        $this->assertContains('test string',$string);

        $file = $loader->load('dummy.txt');
        ob_start();
        require $file;
        $string = ob_get_clean();
        $this->assertInternalType('string',$string);
        $this->assertContains('test string',$string);
    }
    public function testExtensionsWithoutDot()
    {
        $loader = new \Storage\FileLoader(__DIR__.'/test_files/','txt');
        $string = $loader->getAsString('dummy');
        $this->assertInternalType('string',$string);
    }
    public function testExtensions()
    {
        $loader = new \Storage\FileLoader(__DIR__.'/test_files/','.txt');
        $string = $loader->getAsString('dummy');
        $this->assertInternalType('string',$string);
    }
}