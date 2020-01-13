<?php

declare(strict_types=1);

namespace App\Tests\Unit\Entity;

use App\Entity\User;
use App\Entity\UserId;
use PHPUnit\Framework\TestCase;

class UserTest extends TestCase
{
    private const IRRELEVANT = 'irrelevant';

    /** @test */
    public function can_be_created(): void
    {
        $user = new User();

        self::assertInstanceOf(User::class, $user);
        self::assertInstanceOf(UserId::class, $user->getId());
        self::assertContains('ROLE_USER', $user->getRoles());
    }

    /** @test */
    public function user_account_can_be_enabled(): void
    {
        $user = new User();

        $user->setAccountStatus(true);

        self::assertTrue($user->isActiveAccount());
    }

    /** @test */
    public function user_account_can_be_disabled(): void
    {
        $user = new User();

        $user->setAccountStatus(false);

        self::assertFalse($user->isActiveAccount());
    }

    /** @test */
    public function user_account_status_is_disabledby_default(): void
    {
        $user = new User();

        self::assertFalse($user->isActiveAccount());
    }
}
