<?php

namespace Tests;

use Storage\FileLoader;

class LoaderTest extends BaseStorageCase
{
    public function testLoadsImages()
    {
        $loader = new FileLoader(__DIR__.'/test_files/images/');
        $string = $loader->getAsString('planete.jpg');
        $this->assertInternalType('string', $string);
    }

}