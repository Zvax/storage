<?php

class SessionStorageTest extends \Tests\BaseStorageCase
{

    public function testInit()
    {

        $container = new \Storage\PhpSessionStorage();

        $container["key"] = "value";

        $this->assertEquals("value",$container["key"]);

    }

}