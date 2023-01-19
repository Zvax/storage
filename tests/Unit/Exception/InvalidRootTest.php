<?php declare(strict_types=1);

namespace Zvax\Storage\Tests\Unit\Exception;

use PHPUnit\Framework\TestCase;
use Zvax\Storage\Exception\InvalidRoot;

final class InvalidRootTest extends TestCase
{
    /** @test */
    public function returns_message(): void
    {
        $exception = new InvalidRoot('/some/fake/path');
        $this->assertEquals("The path [ /some/fake/path ] is not a valid folder.", $exception->getMessage());
    }
}
