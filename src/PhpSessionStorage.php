<?php declare(strict_types=1);

namespace Zvax\Storage;

class PhpSessionStorage implements Storage
{
    private int $cursor = 0;

    public function offsetExists($offset): bool
    {
        return isset($_SESSION[$offset]);
    }

    public function offsetGet($offset): mixed
    {
        return $_SESSION[$offset];
    }

    public function offsetSet($offset, $value): void
    {
        $_SESSION[$offset] = $value;
    }

    public function offsetUnset($offset): void
    {
        unset($_SESSION[$offset]);
    }

    public function current(): mixed
    {
        return $_SESSION[$this->key()];
    }

    public function next(): void
    {
        $this->cursor++;
    }

    public function key(): string
    {
        $keys = array_keys($_SESSION);
        return $keys[$this->cursor] ?? '';
    }

    public function valid(): bool
    {
        return isset($_SESSION[$this->key()]);
    }

    public function rewind(): void
    {
        $this->cursor = 0;
    }
}
