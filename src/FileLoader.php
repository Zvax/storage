<?php

namespace Storage;

use Storage\Exceptions\InvalidRootException;

class FileLoader implements Loader
{

    private $root;
    private $extension;

    public function __construct($root, $extension = "")
    {
        $root = rtrim($root, '/') . '/';
        if (!is_dir($root)) throw new InvalidRootException($root);
        $this->root = $root;
        $this->extension = '.' . ltrim($extension,'.');
    }

    public function getAsString($key)
    {
        return file_get_contents("$this->root$key$this->extension");
    }

    public function load($key)
    {
        require "$this->root$key$this->extension";
    }

}