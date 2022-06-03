<?php

namespace Storage;

use Storage\Exception\InvalidRoot;

class FileLoader implements Loader
{
    public function __construct(private string $root, private string $extension = "")
    {
        $root = rtrim($root, '/') . '/';
        if (!is_dir($root)) {
            throw new InvalidRoot($root);
        }
        $this->root = $root;

        if ($extension !== '') {
            $this->extension = '.' . ltrim($extension, '.');
        }
    }

    public function getAsString(mixed $key): string
    {
        $file = new File($this->makeFullName($key));

        $contents =  file_get_contents($file);

        return match ($contents) {
            false => '',
            default => $contents,
        };
    }

    private function makeFullName(mixed $key): string
    {
        return sprintf('%s%s%s', $this->root, $key, $this->extension);
    }

    public function load(mixed $key): File
    {
        return new File($this->makeFullName($key));
    }

    public function exists(mixed $key): bool
    {
        return file_exists($this->makeFullName($key));
    }

}
