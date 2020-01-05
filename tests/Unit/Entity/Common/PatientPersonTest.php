<?php

declare(strict_types=1);

namespace App\Tests\Unit\Entity\Common;

use App\Entity\Common\PatientPerson;
use PHPUnit\Framework\TestCase;

class PatientPersonTest extends TestCase
{
    private const IRRELEVANT = 'irrelevant';

    /** @test */
    public function can_be_created(): void
    {
        $patientPerson = new PatientPerson();

        self::assertInstanceOf(PatientPerson::class, $patientPerson);
    }

    /** @test */
    public function can_assign_a_firstname(): void
    {
        $patientPerson = new PatientPerson();

        $patientPerson->setFirstName(self::IRRELEVANT);

        self::assertEquals(self::IRRELEVANT, $patientPerson->getFirstName());
    }

    /** @test */
    public function can_assign_a_middlename(): void
    {
        $patientPerson = new PatientPerson();

        $patientPerson->setMiddleName(self::IRRELEVANT);

        self::assertEquals(self::IRRELEVANT, $patientPerson->getMiddleName());
    }

    /** @test */
    public function can_assign_a_lastname(): void
    {
        $patientPerson = new PatientPerson();

        $patientPerson->setLastName(self::IRRELEVANT);

        self::assertEquals(self::IRRELEVANT, $patientPerson->getLastName());
    }

    /** @test */
    public function can_assign_gender(): void
    {
        $patientPerson = new PatientPerson();

        $patientPerson->setGender('male');

        self::assertEquals('male', $patientPerson->getGender());
    }

    /**
     * @test
     * @expectedException \InvalidArgumentException
     */
    public function cant_assign_invalid_gender(): void
    {
        $patientPerson = new PatientPerson();

        $patientPerson->setGender('xxx');
    }

    /** @test */
    public function can_assign_date_of_birth(): void
    {
        $patientPerson = new PatientPerson();
        $now = new \DateTimeImmutable('now');
        $patientPerson->setDateOfBirth($now);

        self::assertEquals($now, $patientPerson->getDateOfBirth());
    }
}
