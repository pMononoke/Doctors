<?php

declare(strict_types=1);

namespace Medicalmundi\Icd\Tests\Icd9;

use MedicalMundi\Icd\Contract\IcdCodeDescriptionInterface;
use MedicalMundi\Icd\Contract\IcdCodeInterface;
use MedicalMundi\Icd\Contract\IcdInterface;
use MedicalMundi\Icd\Icd9\Icd9;
use MedicalMundi\Icd\Icd9\Icd9Code;
use MedicalMundi\Icd\Icd9\Icd9CodeDescription;
use PHPUnit\Framework\TestCase;

class Icd9Test extends TestCase
{
    private const ICD_CODE = 'xxx.xx.x';

    private const ICD_CODE_DESCRIPTION = 'xxx.xx.x description.';

    /** @test */
    public function can_be_created(): void
    {
        $icd9 = new Icd9(Icd9Code::fromString(self::ICD_CODE), Icd9CodeDescription::fromString(self::ICD_CODE_DESCRIPTION));

        self::assertInstanceOf(IcdInterface::class, $icd9);
        self::assertInstanceOf(Icd9::class, $icd9);
        self::assertInstanceOf(IcdCodeInterface::class, $icd9->code());
        self::assertEquals(self::ICD_CODE, $icd9->code()->value());
        self::assertEquals(self::ICD_CODE, $icd9->code()->toString());
        self::assertEquals(self::ICD_CODE, $icd9->code()->__toString());
        self::assertInstanceOf(IcdCodeDescriptionInterface::class, $icd9->description());
        self::assertEquals(self::ICD_CODE_DESCRIPTION, $icd9->description()->value());
        self::assertEquals(self::ICD_CODE_DESCRIPTION, $icd9->description()->toString());
        self::assertEquals(self::ICD_CODE_DESCRIPTION, $icd9->description()->__toString());
    }

    /** @test */
    public function can_be_compared(): void
    {
        $first = new Icd9(Icd9Code::fromString(self::ICD_CODE), Icd9CodeDescription::fromString(self::ICD_CODE_DESCRIPTION));
        $second = new Icd9(Icd9Code::fromString('yyy.yy.y'), Icd9CodeDescription::fromString('yyy.yy.y description'));
        $same_as_first = new Icd9(Icd9Code::fromString(self::ICD_CODE), Icd9CodeDescription::fromString(self::ICD_CODE_DESCRIPTION));

        self::assertFalse($first->equals($second));
        self::assertTrue($first->equals($same_as_first));
        self::assertFalse($second->equals($same_as_first));
    }

    /**
     * @test
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage Icd code is too short.
     */
    public function short_ICD9_code_throw_exception(): void
    {
        self::markTestSkipped();
        $icdCode = Icd9Code::fromString(self::ICD_CODE);

        self::assertInstanceOf(Icd9Code::class, $icdCode);
    }

    /**
     * @test
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage Icd code is too long.
     */
    public function too_long_ICD9_code_throw_exception(): void
    {
        self::markTestSkipped();
        $icdCode = Icd9Code::fromString(self::ICD_CODE);

        self::assertInstanceOf(Icd9Code::class, $icdCode);
    }

    /**
     * @test
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage ICD-9 code description is too short.
     */
    public function short_ICD9_code_description_throw_exception(): void
    {
        Icd9CodeDescription::fromString('a');
    }

    /**
     * @test
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage ICD-9 code description is too long.
     */
    public function too_long_ICD9_code_description_throw_exception(): void
    {
        $irrelevant = 'aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa';
        $description = $irrelevant.$irrelevant.$irrelevant;

        Icd9CodeDescription::fromString($description);
    }
}
