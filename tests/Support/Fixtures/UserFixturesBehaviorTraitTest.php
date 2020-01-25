<?php

declare(strict_types=1);

namespace App\Tests\Support\Fixtures;

use App\Entity\User;
use PHPUnit\Framework\TestCase;

class UserFixturesBehaviorTraitTest extends TestCase
{
    /** @var object|null */
    private $classUnderTest;

    protected function setUp(): void
    {
        $this->classUnderTest = new class() {
            use UserFixturesBehaviorTrait;
        };
    }

    /** @test */
    public function can_create_irrelevant_user(): void
    {
        $IrrelevantUser = $this->classUnderTest->createIrrelevantUser();

        self::assertInstanceOf(User::class, $IrrelevantUser);
        self::assertTrue($IrrelevantUser->isActiveAccount());
        self::assertEquals('irrelevant@example.com', $IrrelevantUser->getEmail());
        self::assertContains('ROLE_USER', $IrrelevantUser->getRoles());
    }

    /** @test */
    public function can_create_admin_user(): void
    {
        $adminUser = $this->classUnderTest->createAdminUser();

        self::assertInstanceOf(User::class, $adminUser);
        self::assertTrue($adminUser->isActiveAccount());
        self::assertEquals('admin@example.com', $adminUser->getEmail());
        self::assertContains('ROLE_ADMIN', $adminUser->getRoles());
    }

    /** @test */
    public function can_create_physician_user(): void
    {
        $physicianUser = $this->classUnderTest->createPhysicianUser();

        self::assertInstanceOf(User::class, $physicianUser);
        self::assertTrue($physicianUser->isActiveAccount());
        self::assertEquals('physician@example.com', $physicianUser->getEmail());
        self::assertContains('ROLE_PHYSICIAN', $physicianUser->getRoles());
    }

    protected function tearDown(): void
    {
        $this->classUnderTest = null;
    }
}
