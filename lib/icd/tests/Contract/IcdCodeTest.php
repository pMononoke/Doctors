<?php

declare(strict_types=1);

namespace MedicalMundi\Icd\Tests\Contract;

use MedicalMundi\Icd\Contract\IcdCode;
use PHPUnit\Framework\TestCase;

class IcdCodeTest extends TestCase
{
    /** @test */
    public function can_create_IcdDummyCode(): void
    {
        $icdCode = DummyIcdCode::fromString('aa');

        self::assertInstanceOf(IcdCode::class, $icdCode);
    }

    /** @test */
    public function can_return_value(): void
    {
        $value = 'aa';
        $icdCode = DummyIcdCode::fromString($value);

        self::assertInstanceOf(IcdCode::class, $icdCode);
        self::assertEquals($value, $icdCode->value());
    }

    /** @test */
    public function can_return_value_as_string_value(): void
    {
        $value = 'aa';
        $icdCode = DummyIcdCode::fromString($value);

        self::assertInstanceOf(IcdCode::class, $icdCode);
        self::assertEquals($value, $icdCode->toString());
    }

    /** @test */
    public function can_return_string_value_by_method__toString(): void
    {
        $value = 'aa';
        $icdCode = DummyIcdCode::fromString($value);

        self::assertInstanceOf(IcdCode::class, $icdCode);
        self::assertEquals($value, $icdCode->__toString());
    }

    /** @test */
    public function can_be_compared(): void
    {
        $icdCode_first = DummyIcdCode::fromString('first');
        $icdCode_second = DummyIcdCode::fromString('second');
        $icdCode_same_as_first = DummyIcdCode::fromString('first');

        self::assertInstanceOf(IcdCode::class, $icdCode_first);
        self::assertInstanceOf(IcdCode::class, $icdCode_second);

        self::assertFalse($icdCode_first->equals($icdCode_second));
        self::assertTrue($icdCode_first->equals($icdCode_same_as_first));
    }
}
