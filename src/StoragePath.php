<?php

namespace Storage;

use Storage\Exceptions\InvalidRootException;

class StoragePath
{
    private $root;

    public function __construct($root = __DIR__."/../data")
    {
        if (is_dir($root)) $this->root = $root;
        else if (mkdir($root)) $this->root = $root;
        else throw new InvalidRootException($root);
    }

    public function getPath()
    {
        return "$this->root";
    }
}