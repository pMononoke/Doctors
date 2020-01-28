<?php

declare(strict_types=1);

namespace MedicalMundi\Icd\Tests\Contract;

use MedicalMundi\Icd\Contract\IcdCodeDescription;
use PHPUnit\Framework\TestCase;

class IcdCodeDescriptionTest extends TestCase
{
    /** @test */
    public function can_create_IcdCodeDescription(): void
    {
        $icdCodeDescription = DummyIcdCodeDescription::fromString('aa');

        self::assertInstanceOf(IcdCodeDescription::class, $icdCodeDescription);
    }

    /** @test */
    public function can_return_value(): void
    {
        $value = 'aa';
        $icdCodeDescription = DummyIcdCodeDescription::fromString($value);

        self::assertInstanceOf(IcdCodeDescription::class, $icdCodeDescription);
        self::assertEquals($value, $icdCodeDescription->value());
    }

    /** @test */
    public function can_return_value_as_string_value(): void
    {
        $value = 'aa';
        $icdCodeDescription = DummyIcdCodeDescription::fromString($value);

        self::assertInstanceOf(IcdCodeDescription::class, $icdCodeDescription);
        self::assertEquals($value, $icdCodeDescription->toString());
    }

    /** @test */
    public function can_return_string_value_by_method__toString(): void
    {
        $value = 'aa';
        $icdCodeDescription = DummyIcdCodeDescription::fromString($value);

        self::assertInstanceOf(IcdCodeDescription::class, $icdCodeDescription);
        self::assertEquals($value, $icdCodeDescription->__toString());
    }

    /** @test */
    public function can_be_compared(): void
    {
        $first = DummyIcdCodeDescription::fromString('first');
        $second = DummyIcdCodeDescription::fromString('second');
        $same_as_first = DummyIcdCodeDescription::fromString('first');

        self::assertFalse($first->equals($second));
        self::assertTrue($first->equals($same_as_first));
    }
}
