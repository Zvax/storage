<?php

namespace Storage;

use Storage\Exceptions\InvalidRootException;

class FileLoader implements Loader {

    private $root;
    private $extension;

    public function __construct($root,$extension = "") {
        if (!is_dir($root)) throw new InvalidRootException($root);
        $this->root = $root;
        $this->extension = $extension;
    }

    public function load($key) {
        return file_get_contents("$this->root$this->extension");
    }

}