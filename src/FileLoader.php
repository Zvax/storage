<?php declare(strict_types=1);

namespace Zvax\Storage;

use SplFileInfo;
use Zvax\Storage\Exception\InvalidRoot;

final class FileLoader implements Loader
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

    public function getAsString(string $key): string
    {
        $file = new SplFileInfo($this->makeFullName($key));

        $contents =  file_get_contents((string) $file);

        return match ($contents) {
            false => '',
            default => $contents,
        };
    }

    private function makeFullName(string $key): string
    {
        return sprintf('%s%s%s', $this->root, $key, $this->extension);
    }

    public function load(string $key): SplFileInfo
    {
        return new SplFileInfo($this->makeFullName($key));
    }

    public function exists(string $key): bool
    {
        return file_exists($this->makeFullName($key));
    }

}
