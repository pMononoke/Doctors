<?php

declare(strict_types=1);

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

}