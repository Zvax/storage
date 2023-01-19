<?php declare(strict_types=1);

namespace Zvax\Storage;

use DirectoryIterator;

final class FileStorage implements Storage
{
    private int $cursor = 0;

    public function __construct(private readonly string $root)
    {
        if (!is_dir($root)) {
            // todo maybe sanely
            mkdir($root);
        }
    }

    public function offsetExists(mixed $offset): bool
    {
        return file_exists($this->makeFullFileName($offset));
    }

    public function offsetGet(mixed $offset): ?string
    {
        return $this->readFromFile($this->makeFullFileName($offset));
    }

    public function offsetSet(mixed $offset, mixed $value): void
    {
        if (!isset($offset)) {
            return;
        }

        $resourcePath = $this->pathify($offset);

        if (!is_dir($resourcePath)) {
            mkdir($resourcePath, 0755, true);
        }

        file_put_contents($this->makeFullFileName($offset), $value);
    }

    private function makeFullFileName(string $offset): string
    {
        return sprintf('%s/%s', $this->root, $offset);
    }

    private function pathify(string $offset): string
    {
        $bits = explode('/', "$this->root/$offset");
        // wtf am i even doing
        array_pop($bits);
        return implode('/', $bits);
    }

    public function offsetUnset(mixed $offset): void
    {
        unlink($this->makeFullFileName($offset));
    }

    /** @return array<string> */
    private function get_current_keys(): array
    {
        $keys = [];

        foreach (new DirectoryIterator($this->root) as $file_info) {
            if ($file_info->isDot()) {
                continue;
            }

            $keys[] = $file_info->getFilename();
        }

        return $keys;
    }

    public function current(): mixed
    {
        $keys   = $this->get_current_keys();
        $offset = $keys[$this->cursor];

        $file_name = $this->makeFullFileName($offset);
        return $this->readFromFile($file_name);
    }

    private function readFromFile(string $fileName): string
    {
        $contents = file_get_contents($fileName);

        return match ($contents) {
            false => '',
            default => $contents,
        };
    }

    public function next(): void
    {
        $this->cursor++;
    }

    public function key(): mixed
    {
        $keys = $this->get_current_keys();

        return $keys[$this->cursor];
    }

    public function valid(): bool
    {
        $keys = $this->get_current_keys();

        return isset($keys[$this->cursor]);
    }

    public function rewind(): void
    {
        $this->cursor = 0;
    }
}
