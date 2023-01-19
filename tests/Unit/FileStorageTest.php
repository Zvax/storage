<?php declare(strict_types=1);

namespace Zvax\Storage\Tests\Unit;

use PHPUnit\Framework\TestCase;
use Zvax\Storage\FileStorage;

final class FileStorageTest extends TestCase
{
    private const ROOT              = __DIR__ . '/../test_files';
    private const A_THING_FULL_NAME = __DIR__ . '/../test_files/a_thing.txt';

    public function test_stores_a_thing(): void
    {
        if (file_exists(self::A_THING_FULL_NAME)) {
            unlink(self::A_THING_FULL_NAME);
        }
        $this->assertFileDoesNotExist(self::A_THING_FULL_NAME);

        $storage = new FileStorage(self::ROOT);
        $storage['a_thing.txt'] = 'a value';

        $this->assertFileExists(self::A_THING_FULL_NAME);

        $this->assertEquals('a value', $storage['a_thing.txt']);
    }

    public function test_deletes_a_thing(): void
    {
        $storage = new FileStorage(__DIR__ . '/../test_files');

        if (!file_exists(self::A_THING_FULL_NAME)) {
            $storage['a_thing.txt'] = 'a value';
        }

        unset($storage['a_thing.txt']);

        $this->assertFileDoesNotExist(self::A_THING_FULL_NAME);
    }

    public function test_basic_interface_implementation(): void
    {
        $storage = new FileStorage(__DIR__ . '/../test_files');

        $this->assertTrue(isset($storage['dummy.txt']));
    }

    public function test_automatically_creates_folder(): void
    {
        if (file_exists(__DIR__ . '/../test_files/new_folder')) {
            rmdir(__DIR__ . '/../test_files/new_folder');
        }
        new FileStorage(__DIR__ . '/../test_files/new_folder');
        $this->assertFileExists(__DIR__ . '/../test_files/new_folder');
        rmdir(__DIR__ . '/../test_files/new_folder');
    }

    public function testIteratesOverFolder(): void
    {
        $storage = new FileStorage(self::ROOT);

        $mapped_folder_content = [];

        foreach ($storage as $key => $value) {
            $mapped_folder_content[$key] = $value;
        }

        $this->assertCount(2, $mapped_folder_content);
        $this->assertStringEqualsFile(sprintf('%s/%s', self::ROOT, 'dummy.txt'), $mapped_folder_content['dummy.txt']);
        $this->assertStringEqualsFile(sprintf('%s/%s', self::ROOT, 'file_2.txt'), $mapped_folder_content['file_2.txt']);
    }
}


