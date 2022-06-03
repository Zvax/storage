<?php declare(strict_types=1);

namespace Storage\Tests\Unit;

use PHPUnit\Framework\TestCase;
use Storage\Exception\InvalidFile;
use Storage\File;

class FileTest extends TestCase
{
    /** @test */
    public function shows_as_string(): void
    {
        $file = new File(__DIR__ . '/FileTest.php');
        $this->assertEquals(__DIR__ . '/FileTest.php', (string)$file);
    }
    /** @test */
    public function throws_on_invalid_file(): void
    {
        $this->expectException(InvalidFile::class);
        new File('unknown_file.txt');
    }
}
