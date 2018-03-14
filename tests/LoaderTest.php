<?php declare(strict_types=1);

namespace Storage\Tests;

use PHPUnit\Framework\TestCase;
use Storage\FileLoader;

class LoaderTest extends TestCase
{
    /** @test */
    public function loads_images(): void
    {
        $loader = new FileLoader(__DIR__ . '/test_files/images/');
        $string = $loader->getAsString('planete.jpg');
        $this->assertIsString($string);
    }
}
