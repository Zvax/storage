<?php

namespace Storage;

class FileStorage implements Storage
{
    public function __construct(private string $root)
    {
        if (!is_dir($root)) {
            // todo maybe sanely
            mkdir($root);
        }
    }

    public function offsetExists($offset): bool
    {
        return file_exists("$this->root/$offset");
    }

    public function offsetGet($offset): mixed
    {
        return file_get_contents("$this->root/$offset");
    }

    public function offsetSet($offset, $value): void
    {
        if (!is_dir($this->pathify($offset))) {
            mkdir($this->pathify($offset), 0755, true);
        }
        file_put_contents("$this->root/$offset", $value);
    }

    public function offsetUnset($offset): void
    {
        unlink("$this->root/$offset");
    }

    public function getPath($offset): string
    {
        return "$this->root/$offset";
    }

    private function pathify($offset): string
    {
        $bits = explode('/', "$this->root/$offset");
        // wtf am i even doing
        array_pop($bits);
        return implode('/', $bits);
    }

}