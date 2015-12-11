<?php

namespace Storage;

use Storage\Exceptions\InvalidFileException;

class File
{
    private $path;

    public function __construct($path) {
        if (!file_exists($path))
        {
            throw new InvalidFileException($path);
        }
        $this->path = $path;
    }

    public function __toString()
    {
        return "$this->path";
    }

}