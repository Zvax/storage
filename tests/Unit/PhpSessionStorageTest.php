<?php declare(strict_types=1);

namespace Storage\Tests;

use PHPUnit\Framework\TestCase;
use Storage\PhpSessionStorage;

class PhpSessionStorageTest extends TestCase
{
    /** @test */
    public function inits(): void
    {
        $container = new PhpSessionStorage;
        $container['key'] = 'value';
        $this->assertEquals('value', $container['key']);
        $this->assertTrue(isset($container['key']));

        unset($container['key']);
        $this->assertFalse(isset($container['key']));

    }
}
