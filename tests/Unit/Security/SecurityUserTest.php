<?php

declare(strict_types=1);
/**
 * /tests/Unit/Security/SecurityUserTest.php.
 *
 * @author TLe, Tarmo Leppänen <tarmo.leppanen@protacon.com>
 */

namespace App\Tests\Unit\Security;

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class SecurityUserTest extends KernelTestCase
{
    /** @test */
    public function getRoles_method_returns_expected_values(): void
    {
        $user = new User();
        $user->setRoles(['Foo', 'Bar']);

        $expectedRoles = ['Foo', 'Bar', 'ROLE_USER'];

        static::assertSame($expectedRoles, $user->getRoles());
    }

    /** @test */
    public function getPassword_method_returns_expected_value(): void
    {
        $user = new User();
        $user->setPassword('xxx-xxx');

        static::assertSame('xxx-xxx', $user->getPassword());
    }

    /** @test */
    public function getSalt_method_return_nothing(): void
    {
        /** @noinspection UnnecessaryAssertionInspection */
        /** @noinspection PhpVoidFunctionResultUsedInspection */
        $user = new User();
        static::assertNull($user->getSalt());
    }

    /** @test */
    public function getUsername_returns_expected_value(): void
    {
        $email = 'irrelevant@example.com';
        $user = new User();
        $user->setEmail($email);

        static::assertSame($email, $user->getUsername());
    }
}
