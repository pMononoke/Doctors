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
        self::assertNull($user->getFirstName());
        self::assertNull($user->getLastName());
        self::assertContains('ROLE_USER', $user->getRoles());
    }

    /** @test */
    public function build_a_user_with_parameters(): void
    {
        $builder = UserBuilder::create()
            ->withEmail('example@example.com')
            ->withFirstName('joe')
            ->withEnabledAccount()
            //->withDisabledAccount()
            ->withRoles(['ROLE_ADMIN', 'ROLE_ACCOUNTANT'])
        ;

        /** @var User $user */
        $user = $builder->build();

        self::assertInstanceOf(User::class, $user);
        self::assertEquals('example@example.com', $user->getEmail());
        self::assertEquals('joe', $user->getFirstName());
        self::assertTrue($user->isActiveAccount());
        //self::assertFalse($user->isActiveAccount());
        self::assertContains('ROLE_ADMIN', $user->getRoles());
        self::assertContains('ROLE_ACCOUNTANT', $user->getRoles());
    }

    /** @test */
    public function missing_parameter_AccountStatus_set_disabled_account_as_default(): void
    {
        $builder = UserBuilder::create();

        /** @var User $user */
        $user = $builder->build();

        self::assertFalse($user->isActiveAccount());
    }

    /** @test */
    public function missing_parameter_Roles_set_ROLE_USER_as_default(): void
    {
        $builder = UserBuilder::create();

        /** @var User $user */
        $user = $builder->build();

        self::assertContains('ROLE_USER', $user->getRoles());
    }
}
