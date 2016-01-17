<?php

namespace Storage;

use Storage\Exceptions\InvalidRootException;

class FileLoader implements Loader
{

    private $root;
    private $extension;

    public function __construct($root,$extension = "")
    {
        $root = rtrim($root,'/') . '/';
        if (!is_dir($root)) throw new InvalidRootException($root);
        $this->root = $root;
        $this->extension = strlen($extension) ? '.' . ltrim($extension,'.') : "";
    }

    public function getAsString($key)
    {
        $file = new File($this->makeFullName($key));
        ob_start();
        require $file;
        return ob_get_clean();
    }

    public function load($key)
    {
        return new File($this->makeFullName($key));
    }

    public function exists($key)
    {
        return file_exists($this->makeFullName($key));
    }

    private function makeFullName($key)
    {
        return "$this->root$key$this->extension";
    }

}