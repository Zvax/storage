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
        $file = new File("$this->root$key$this->extension");
        ob_start();
        require $file;
        return ob_get_clean();
    }

    public function load($key)
    {
        return new File("$this->root$key$this->extension");
    }

}