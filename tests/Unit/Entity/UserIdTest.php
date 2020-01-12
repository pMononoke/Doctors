<?php

declare(strict_types=1);

namespace App\Tests\Unit\Entity;

use App\Entity\UserId;
use PHPUnit\Framework\TestCase;

class UserIdTest extends TestCase
{
    private const UUID = '100ade38-ad18-4cf4-9ac5-de2b00c4abb7';

    /** @test */
    public function can_autogenerate_a_userId_object(): void
    {
        self::assertInstanceOf(UserId::class, UserId::generate());
    }

    /** @test */
    public function can_be_created_from_string(): void
    {
        $userId = UserId::fromString(self::UUID);

        self::assertEquals(self::UUID, $userId->toString());
        self::assertEquals(self::UUID, $userId->__toString());
    }

    /** @test */
    public function can_be_compared(): void
    {
        $first = UserId::fromString(self::UUID);
        $second = UserId::generate();
        $copyOfFirst = UserId::fromString(self::UUID);

        self::assertFalse($first->equals($second));
        self::assertTrue($first->equals($copyOfFirst));
        self::assertFalse($second->equals($copyOfFirst));
    }
}
