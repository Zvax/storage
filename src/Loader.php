<?php

namespace Zvax\Storage;

use SplFileInfo;

interface Loader
{
    public function load(string $key): SplFileInfo;

    public function getAsString(string $key): string;

    public function exists(string $key): bool;
}
