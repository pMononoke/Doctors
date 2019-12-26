<?php

declare(strict_types=1);

namespace App\Tests\Support\Builder;

use App\Entity\Patient;
use App\Entity\PatientId;

class PatientBuilder implements BuilderInterface
{
    /** @var PatientId|null */
    private $id;

    /** @var string|null */
    private $firstName;

    /** @var string|null */
    private $middleName;

    /** @var string|null */
    private $lastName;

    /** @var string|null */
    private $gender;

    /** @var \DateTimeImmutable|null */
    private $createAt;

    /** @var \DateTimeImmutable|null */
    private $updateAt;

    /** @var mixed|null */
    private $clockService;

    /**
     * PatientBuilder constructor.
     */
    public function __construct(PatientId $patientId = null, ?string $firstName = null, ?string $middleName = null, ?string $lastName = null)
    {
        $this->id = $patientId;
        $this->firstName = $firstName;
        $this->middleName = $middleName;
        $this->lastName = $lastName;
    }

    /**
     * @param mixed $clockService
     */
    public function setClockService($clockService): void
    {
        $this->clockService = $clockService;
    }

    /**
     * Create the builder.
     */
    public static function create(): PatientBuilder
    {
        return new self(
            PatientId::generate(),
            'irrelevant',
            'irrelevant',
            'irrelevant'
        );
    }

    /**
     * Build and return the object the builder takes care of.
     */
    public function build(): Patient
    {
        $patient = new Patient();

        //TODO
        // or $this->firstName ?? $patient->setFirstName($this->firstName);
        $patient->setId($this->id);
        $patient->setFirstName($this->firstName);
        $patient->setMiddleName($this->middleName);
        $patient->setLastName($this->lastName);

        $patient->setGender($this->gender);

        $dateNow = new \DateTimeImmutable('now');
        $this->createAt ? $patient->setCreatedAt($this->createAt) : $patient->setCreatedAt($dateNow);
        $this->updateAt ? $patient->setUpdatedAt($this->updateAt) : $patient->setUpdatedAt($dateNow);

        return $patient;
    }

    public function withFirstName(string $firstName): PatientBuilder
    {
        $copy = $this->copy();
        $copy->firstName = $firstName;

        return $copy;
    }

    public function withMiddleName(string $middleName): PatientBuilder
    {
        $copy = $this->copy();
        $copy->middleName = $middleName;

        return $copy;
    }

    public function withLastName(string $lastName): PatientBuilder
    {
        $copy = $this->copy();
        $copy->lastName = $lastName;

        return $copy;
    }

    public function withGender(string $gender): PatientBuilder
    {
        $copy = $this->copy();
        $copy->gender = $gender;

        return $copy;
    }

    private function copy(): PatientBuilder
    {
        return new self(
            $this->id,
            $this->firstName,
            $this->middleName,
            $this->lastName
        );
    }
}
