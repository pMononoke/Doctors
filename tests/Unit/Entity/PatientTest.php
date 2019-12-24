<?php

declare(strict_types=1);

namespace App\Tests\Unit\Entity;

use App\Entity\Patient;
use PHPUnit\Framework\TestCase;

class PatientTest extends TestCase
{
    /** @test */
    public function can_be_created(): void
    {
        $patient = new Patient();

        self::assertInstanceOf(Patient::class, $patient);
    }

    /** @test */
    public function can_change_firstname(): void
    {
        $patient = new Patient();

        $patient->setFirstName('irrelevat');

        self::assertEquals('irrelevat', $patient->getFirstName());
    }

    /** @test */
    public function can_change_middlename(): void
    {
        $patient = new Patient();

        $patient->setMiddleName('irrelevat');

        self::assertEquals('irrelevat', $patient->getMiddleName());
    }

    /** @test */
    public function can_change_lastname(): void
    {
        $patient = new Patient();

        $patient->setLastName('irrelevat');

        self::assertEquals('irrelevat', $patient->getLastName());
    }
}
