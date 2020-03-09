<?php

declare(strict_types=1);

namespace Medicalmundi\Icd\Tests\Icd9;

use MedicalMundi\Icd\Contract\IcdCodeDescriptionInterface;
use MedicalMundi\Icd\Contract\IcdCodeInterface;
use MedicalMundi\Icd\Contract\IcdInterface;
use MedicalMundi\Icd\Icd10\Icd10;
use MedicalMundi\Icd\Icd10\Icd10Code;
use MedicalMundi\Icd\Icd10\Icd10CodeDescription;
use PHPUnit\Framework\TestCase;

class Icd10Test extends TestCase
{
    private const ICD_CODE = 'xxx.xx.x';

    private const ICD_CODE_DESCRIPTION = 'xxx.xx.x description.';

    /** @test */
    public function can_be_created(): void
    {
        $icd10 = new Icd10(Icd10Code::fromString(self::ICD_CODE), Icd10CodeDescription::fromString(self::ICD_CODE_DESCRIPTION));

        self::assertInstanceOf(IcdInterface::class, $icd10);
        self::assertInstanceOf(Icd10::class, $icd10);
        self::assertInstanceOf(IcdCodeInterface::class, $icd10->code());
        self::assertEquals(self::ICD_CODE, $icd10->code()->value());
        self::assertEquals(self::ICD_CODE, $icd10->code()->toString());
        self::assertEquals(self::ICD_CODE, $icd10->code()->__toString());
        self::assertInstanceOf(IcdCodeDescriptionInterface::class, $icd10->description());
        self::assertEquals(self::ICD_CODE_DESCRIPTION, $icd10->description()->value());
        self::assertEquals(self::ICD_CODE_DESCRIPTION, $icd10->description()->toString());
        self::assertEquals(self::ICD_CODE_DESCRIPTION, $icd10->description()->__toString());
    }

    /** @test */
    public function can_be_compared(): void
    {
        $first = new Icd10(Icd10Code::fromString(self::ICD_CODE), Icd10CodeDescription::fromString(self::ICD_CODE_DESCRIPTION));
        $second = new Icd10(Icd10Code::fromString('yyy.yy.y'), Icd10CodeDescription::fromString('yyy.yy.y description'));
        $same_as_first = new Icd10(Icd10Code::fromString(self::ICD_CODE), Icd10CodeDescription::fromString(self::ICD_CODE_DESCRIPTION));

        self::assertFalse($first->equals($second));
        self::assertTrue($first->equals($same_as_first));
        self::assertFalse($second->equals($same_as_first));
    }

    /**
     * @test
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage Icd code is too short.
     */
    public function short_ICD10_code_throw_exception(): void
    {
        self::markTestSkipped('add validation rules');
        Icd10Code::fromString('xx');
    }

    /**
     * @test
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage Icd code is too long.
     */
    public function too_long_ICD10_code_throw_exception(): void
    {
        self::markTestSkipped();
        Icd10Code::fromString(self::ICD_CODE);
    }

    /**
     * @test
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage ICD-10 code description is too short.
     */
    public function short_ICD10_code_description_throw_exception(): void
    {
        Icd10CodeDescription::fromString('a');
    }

    /**
     * @test
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage ICD-10 code description is too long.
     */
    public function too_long_ICD10_code_description_throw_exception(): void
    {
        $irrelevant = 'aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa';
        $description = $irrelevant.$irrelevant.$irrelevant;

        Icd10CodeDescription::fromString($description);
    }
}
