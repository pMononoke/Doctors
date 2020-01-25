<?php

declare(strict_types=1);

namespace App\Tests\Unit\Security;

use App\Infrastructure\Security\PasswordGenerator;
use PHPUnit\Framework\TestCase;

class PasswordGeneratorTest extends TestCase
{
    /** @test */
    public function can_generate_strong_password(): void
    {
        $passwordGenerator = new PasswordGenerator();
        $password = $passwordGenerator->generateStrongPassword();

        $this->assertTrue($passwordGenerator->isStrong($password));
        $this->assertFalse($passwordGenerator->isWeak($password));
    }

    /** @test */
    public function testIsStrongPassword(): void
    {
        $password = 'Th1sShudBStrong.';

        $passwordGenerator = new PasswordGenerator();
        $this->assertTrue($passwordGenerator->isStrong($password));
        $this->assertFalse($passwordGenerator->isVeryStrong($password));
        $this->assertFalse($passwordGenerator->isWeak($password));
    }

    /** @test */
    public function testIsVeryStrongPassword(): void
    {
        $password = 'Th1sSh0uldBV3ryStrong!';

        $passwordGenerator = new PasswordGenerator();
        $this->assertTrue($passwordGenerator->isVeryStrong($password));
        $this->assertTrue($passwordGenerator->isStrong($password));
        $this->assertFalse($passwordGenerator->isWeak($password));
    }

    /** @test */
    public function testIsWeakPassword(): void
    {
        $password = 'Weakness';

        $passwordGenerator = new PasswordGenerator();
        $this->assertFalse($passwordGenerator->isVeryStrong($password));
        $this->assertFalse($passwordGenerator->isStrong($password));
        $this->assertTrue($passwordGenerator->isWeak($password));
    }
}
