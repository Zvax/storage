<?php declare(strict_types=1);

namespace Storage\Test;

use PHPUnit\Framework\TestCase;
use Storage\PhpSessionStorage;

class SessionStorageTest extends TestCase
{
    /** @test */
    public function inits(): void
    {
        $container = new PhpSessionStorage;
        $container['key'] = 'value';
        $this->assertEquals('value', $container['key']);
    }
}
