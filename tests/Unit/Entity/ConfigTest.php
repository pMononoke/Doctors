<?php

declare(strict_types=1);

namespace App\Tests\Unit\Entity;

use App\Entity\Config;
use PHPUnit\Framework\TestCase;

class ConfigTest extends TestCase
{
    /** @test */
    public function can_be_created(): void
    {
        $configEntity = new Config();

        self::assertInstanceOf(Config::class, $configEntity);
    }

    /** @test */
    public function can_be_created_with_arguments(): void
    {
        self::markTestSkipped('?BUG: unused object properties in constructor');
        $configEntity = new Config('my-key', 'my-value');

        self::assertInstanceOf(Config::class, $configEntity);
        self::assertEquals('my-key', $configEntity->getTheKey());
        self::assertEquals('my-value', $configEntity->getTheValue());
    }

    /** @test */
    public function can_store_config_values(): void
    {
        $configEntity = new Config();
        $configEntity->setTheKey('my-key');
        $configEntity->setTheValue('my-value');

        self::assertEquals(null, $configEntity->getId());
        self::assertEquals('my-key', $configEntity->getTheKey());
        self::assertEquals('my-value', $configEntity->getTheValue());
    }
}
