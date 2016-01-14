<?php

namespace Storage;

interface Loader {
    public function load($key);
    public function getAsString($key);
    public function exists($key);
}