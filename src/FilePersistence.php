<?php

namespace Storage;

class FilePersistence implements Persistence
{
    private $root;

    public function __construct(StoragePath $path)
    {
        $this->root = $path->getPath();
    }

    public function persist($key, $object)
    {
        $string = serialize($object);
        file_put_contents("$this->root/$key", $string);
    }
}