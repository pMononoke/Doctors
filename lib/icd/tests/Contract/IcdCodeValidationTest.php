<?php

declare(strict_types=1);

namespace MedicalMundi\Icd\Tests\Contract;

use MedicalMundi\Icd\Contract\IcdCode;
use PHPUnit\Framework\TestCase;

class IcdCodeValidationTest extends TestCase
{
    /** @test */
    public function can_create_IcdCodeWithValidation(): void
    {
        $icdCode = DummyIcdCodeWithValidation::fromString('aaaa');

        self::assertInstanceOf(IcdCode::class, $icdCode);
    }

    /**
     * @test
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage Icd code is too short.
     */
    public function short_code_validation_throw_exception(): void
    {
        $icdCode = DummyIcdCodeWithValidation::fromString('aa');

        self::assertInstanceOf(IcdCode::class, $icdCode);
    }

    /**
     * @test
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage Icd code is too long.
     */
    public function too_long_code_validation_throw_exception(): void
    {
        $icdCode = DummyIcdCodeWithValidation::fromString('aaaaaaaaaaaaaaaaa');

        self::assertInstanceOf(IcdCode::class, $icdCode);
    }
}
