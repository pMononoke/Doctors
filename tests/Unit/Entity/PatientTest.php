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

    /** @test */
    public function can_change_date_of_birth(): void
    {
        $patient = new Patient();
        $now = new \DateTimeImmutable('now');
        $patient->setDateOfBirth($now);

        self::assertEquals($now, $patient->getDateOfBirth());
    }

    /** @test */
    public function can_change_date_of_creation(): void
    {
        $patient = new Patient();
        $now = new \DateTimeImmutable('now');
        $patient->setCreatedAt($now);

        self::assertEquals($now, $patient->getCreatedAt());
    }

    /** @test */
    public function can_change_date_of_last_update(): void
    {
        $patient = new Patient();
        $now = new \DateTimeImmutable('now');
        $patient->setUpdatedAt($now);

        self::assertEquals($now, $patient->getUpdatedAt());
    }
}
