<?php

declare(strict_types=1);

namespace App\Tests\Support\Builder;

use App\Entity\Patient;
use PHPUnit\Framework\TestCase;

class PatientBuilderTest extends TestCase
{
    /** @test */
    public function build_a_patient_with_no_data(): void
    {
        $builder = PatientBuilder::create()->withGender('female');
        $patient = $builder->build();

        self::assertInstanceOf(Patient::class, $patient);
        self::assertEquals('irrelevant', $patient->getFirstName());
        self::assertEquals('irrelevant', $patient->getMiddleName());
        self::assertEquals('irrelevant', $patient->getLastName());
        self::assertEquals('female', $patient->getGender());
    }

    /** @test */
    public function build_a_patient_with_configured_properties(): void
    {
        $builder = PatientBuilder::create()
            ->withFirstName('joe')
            ->withMiddleName('smith')
            ->withLastName('doe')
            ->withGender('male');
        $patient = $builder->build();

        self::assertInstanceOf(Patient::class, $patient);
        self::assertEquals('joe', $patient->getFirstName());
        self::assertEquals('smith', $patient->getMiddleName());
        self::assertEquals('doe', $patient->getLastName());
        self::assertEquals('male', $patient->getGender());
    }
}
