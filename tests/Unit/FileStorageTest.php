<?php declare(strict_types=1);

namespace Storage\Tests\Unit;

use PHPUnit\Framework\TestCase;
use Storage\FileStorage;

class FileStorageTest extends TestCase
{
    private const A_THING_FULL_NAME = __DIR__ . '/../test_files/a_thing.txt';

    /** @test */
    public function stores_a_thing(): void
    {
        if (file_exists(self::A_THING_FULL_NAME)) {
            unlink(self::A_THING_FULL_NAME);
        }
        $this->assertFileDoesNotExist(self::A_THING_FULL_NAME);

        $storage = new FileStorage(__DIR__ . '/../test_files');
        $storage['a_thing.txt'] = 'a value';

        $this->assertFileExists(self::A_THING_FULL_NAME);

        $this->assertEquals('a value', $storage['a_thing.txt']);
    }

    /** @test */
    public function deletes_a_thing(): void
    {
        $storage = new FileStorage(__DIR__ . '/../test_files');

        if (!file_exists(self::A_THING_FULL_NAME)) {
            $storage['a_thing.txt'] = 'a value';
        }

        unset($storage['a_thing.txt']);

        $this->assertFileDoesNotExist(self::A_THING_FULL_NAME);
    }

    /** @test */
    public function basic_interface_implementation(): void
    {
        $storage = new FileStorage(__DIR__ . '/../test_files');

        $this->assertTrue(isset($storage['dummy.txt']));
    }

    /** @test */
    public function automatically_creates_folder(): void
    {
        if (file_exists(__DIR__ . '/../test_files/new_folder')) {
            rmdir(__DIR__ . '/../test_files/new_folder');
        }
        new FileStorage(__DIR__ . '/../test_files/new_folder');
        $this->assertFileExists(__DIR__ . '/../test_files/new_folder');
        rmdir(__DIR__ . '/../test_files/new_folder');
    }
}


