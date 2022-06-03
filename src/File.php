<?php

namespace Storage;

use Storage\Exception\InvalidFile;

class File
{
    public function __construct(private string $path)
    {
        if (!file_exists($path)) {
            throw new InvalidFile($path);
        }
    }

    public function __toString()
    {
        return $this->path;
    }
}
