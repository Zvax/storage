<?php

namespace Storage;

class FileStorage implements Storage
{
    public function __construct(private readonly string $root)
    {
        if (!is_dir($root)) {
            // todo maybe sanely
            mkdir($root);
        }
    }

    public function offsetExists(mixed $offset): bool
    {
        return file_exists($this->makeFullPath($offset));
    }

    public function offsetGet(mixed $offset): mixed
    {
        return file_get_contents($this->makeFullPath($offset));
    }

    public function offsetSet($offset, $value): void
    {
        if (!is_dir($this->pathify($offset))) {
            mkdir($this->pathify($offset), 0755, true);
        }
        file_put_contents("$this->root/$offset", $value);
    }

    private function makeFullPath(mixed $offset): string
    {
        return sprintf('%s/%s', $this->root, $offset);
    }

    private function pathify(mixed $offset): string
    {
        $bits = explode('/', "$this->root/$offset");
        // wtf am i even doing
        array_pop($bits);
        return implode('/', $bits);
    }

    public function offsetUnset(mixed $offset): void
    {
        unlink($this->makeFullPath($offset));
    }

}
