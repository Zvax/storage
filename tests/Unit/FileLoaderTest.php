<?php declare(strict_types=1);

namespace Zvax\Storage\Tests\Unit;

use PHPUnit\Framework\TestCase;
use SplFileInfo;
use Zvax\Storage\FileLoader;
use Zvax\Storage\Loader;

final class FileLoaderTest extends TestCase
{
    /** @test */
    public function instantiates(): void
    {
        $loader = new FileLoader(__DIR__);
        $this->assertInstanceOf(Loader::class, $loader);
    }

    /** @test */
    public function can_see_existing_files(): void
    {
        $loader = new FileLoader(__DIR__);
        $this->assertTrue($loader->exists('FileLoaderTest.php'));
    }

    /** @test */
    public function works_without_trailling_slash(): void
    {
        $loader = new FileLoader(__DIR__ . '/../test_files', 'txt');
        $string = $loader->getAsString('dummy');
        $this->assertIsString($string);
    }

    /** @test */
    public function loads(): void
    {
        $loader = new FileLoader(__DIR__ . '/../test_files/', 'txt');
        $string = $loader->getAsString('dummy');
        $this->assertIsString($string);
        $this->assertStringContainsString('test string', $string);

        $file = $loader->load('dummy');
        ob_start();
        require $file;
        $string = ob_get_clean();
        $this->assertIsString($string);
        $this->assertStringContainsString('test string', $string);
    }

    /** @test */
    public function extensions_without_dot(): void
    {
        $loader = new FileLoader(__DIR__ . '/../test_files/', 'txt');
        $string = $loader->getAsString('dummy');
        $this->assertIsString($string);
    }

    /** @test */
    public function extensions_work(): void
    {
        $loader = new FileLoader(__DIR__ . '/../test_files/', '.txt');
        $string = $loader->getAsString('dummy');
        $this->assertIsString($string);
    }

    /** @test */
    public function works_without_extensions(): void
    {
        $loader = new FileLoader(__DIR__ . '/../test_files/');
        $file = $loader->load('dummy.txt');
        $this->assertInstanceOf(SplFileInfo::class, $file);
    }
}
