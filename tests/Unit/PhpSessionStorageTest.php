<?php declare(strict_types=1);

namespace Zvax\Storage\Tests\Unit;

use PHPUnit\Framework\TestCase;
use Zvax\Storage\PhpSessionStorage;

final class PhpSessionStorageTest extends TestCase
{
    public function test_inits(): void
    {
        $container = new PhpSessionStorage;
        $container['key'] = 'value';
        $this->assertEquals('value', $container['key']);
        $this->assertTrue(isset($container['key']));

        unset($container['key']);
        $this->assertFalse(isset($container['key']));

    }

    public function test_iterates(): void
    {
        $container = new PhpSessionStorage;
        $container['key'] = 'value';

        $mapped = [];

        foreach ($container as $key => $value) {
            $mapped[$key] = $value;
        }

        $this->assertCount(1, $mapped);
        $this->assertSame('value', $mapped['key']);
    }
}
