<?php

namespace Tests;

use Gravatalonga\DriverManager\ExceptionManager;
use Gravatalonga\DriverManager\Manager;
use PHPUnit\Framework\TestCase;

class ManagerTest extends TestCase
{
    /**
     * @test
     */
    public function get_setting_by_name()
    {
        $manager = new Manager([
            'default' => ['my-default-driver'],
        ]);

        $this->assertIsArray($manager->driver('default'));
        $this->assertEquals(['my-default-driver'], $manager->driver('default'));
    }

    /** @test */
    public function if_driver_not_found_raise_exception()
    {
        $this->expectException(ExceptionManager::class);
        $this->expectExceptionMessage("driver not-exists not exists.");

        $manager = new Manager([
            'default' => ['my-default-driver'],
        ]);

        $manager->driver('not-exists');
    }

    /** @test */
    public function if_string_is_provider_raise_exception()
    {
        $this->expectException(ExceptionManager::class);
        $this->expectExceptionMessage("driver configuration must be array");

        new Manager([
            'default' => 'my-default-driver',
        ]);
    }

    /** @test */
    public function declare_some_items_as_required()
    {
        $this->expectException(ExceptionManager::class);
        $this->expectExceptionMessage("driver default missing required setting host");

        new Manager([
            'default' => [
                'username' => 'my-default-driver',
            ],
        ], ['host']);
    }

    /** @test */
    public function it_can_populate_driver_with_default_keys()
    {
        $manager = new Manager([
            'default' => [
                'username' => 'my-default-driver',
            ],
        ], [], ['host' => '', 'driver' => 'sqlite', 'username' => 'root', 'password' => 1234]);

        $this->assertSame([
            'username' => 'my-default-driver',
            'host' => '',
            'driver' => 'sqlite',
            'password' => 1234,
        ], $manager->driver('default'));
    }
}
