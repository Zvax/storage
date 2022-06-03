<?php

namespace Storage;

interface Loader
{
    public function load(mixed $key): File;

    public function getAsString(mixed $key): string;

    public function exists(mixed $key): bool;
}
