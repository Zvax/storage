<?php

namespace Storage;

class PhpSessionStorage implements Storage
{
    public function offsetExists($offset)
    {
        return isset($_SESSION[$offset]);
    }
    public function offsetGet($offset)
    {
        return $_SESSION[$offset];
    }
    public function offsetSet($offset,$value)
    {
        $_SESSION[$offset] = $value;
    }
    public function offsetUnset($offset)
    {
        unset($_SESSION[$offset]);
    }
}