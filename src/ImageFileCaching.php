<?php

namespace Storage;

/**
 * Class ImageFileCaching
 * @package Storage
 *
 * should save images on disc
 * following some kind of hierarchy
 *
 */

class ImageFileCaching {

    private $storage;

    public function __construct(\ArrayAccess $storage) {
        $this->storage = $storage;
    }

    public function isCached($key) {
        return isset($this->storage["$key"]);
    }

    public function cache($key,$value) {
        $this->storage[$key] = $value;
    }

    public function get($key) {
        return isset($this->storage[$key])
            ? $this->storage[$key]
            : "unset value $key";
    }

}