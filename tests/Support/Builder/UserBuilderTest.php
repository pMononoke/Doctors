<?php

declare(strict_types=1);

namespace App\Tests\Support\Builder;

use App\Entity\User;
use PHPUnit\Framework\TestCase;

class UserBuilderTest extends TestCase
{
    /** @test */
    public function build_a_user_without_parameters(): void
    {
        $builder = UserBuilder::create();

        /** @var User $user */
        $user = $builder->build();

        self::assertInstanceOf(User::class, $user);
        self::assertNotNull($user->getId());
        self::assertNull($user->getEmail());
    }

    /** @test */
    public function build_a_user_with_parameters(): void
    {
        $builder = UserBuilder::create()
            ->withEmail('example@example.com')
            ->withEnabledAccount()
            //->withDisabledAccount()
        ;

        /** @var User $user */
        $user = $builder->build();

        self::assertInstanceOf(User::class, $user);
        self::assertEquals('example@example.com', $user->getEmail());
        self::assertTrue($user->isActiveAccount());
        //self::assertFalse($user->isActiveAccount());
    }
}
