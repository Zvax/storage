<?php declare(strict_types=1);

namespace Zvax\Storage\Tests\Unit\Exception;

use PHPUnit\Framework\TestCase;
use Zvax\Storage\Exception\InvalidFile;

final class InvalidFileTest extends TestCase
{
    /** @test */
    public function returns_message(): void
    {
        $exception = new InvalidFile('some_file.txt');
        $this->assertEquals("The file [ some_file.txt ] doesn't exist", $exception->getMessage());
    }
}
