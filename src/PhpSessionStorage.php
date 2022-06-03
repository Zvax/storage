<?php

namespace Storage;

class PhpSessionStorage implements Storage
{
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
}
