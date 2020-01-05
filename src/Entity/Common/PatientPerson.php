<?php

declare(strict_types=1);

namespace App\Entity\Common;

use Doctrine\ORM\Mapping as ORM;
use InvalidArgumentException;

/**
 * @ORM\Embeddable
 */
class PatientPerson
{
    /**
     * @var string
     * @ORM\Column(type = "string")
     */
    private $firstName;

    /**
     * @var string
     * @ORM\Column(type = "string", nullable=true)
     */
    private $middleName;

    /**
     * @var string
     * @ORM\Column(type = "string")
     */
    private $lastName;

    /**
     * @var string
     * @ORM\Column(type = "string")
     */
    private $gender;

    /**
     * @var \DateTimeImmutable
     * @ORM\Column(type = "datetimetz_immutable", nullable=true)
     */
    private $dateOfBirth;

    public function getFirstName(): string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): self
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getMiddleName(): ?string
    {
        return $this->middleName;
    }

    public function setMiddleName(string $middleName): self
    {
        $this->middleName = $middleName;

        return $this;
    }

    public function getLastName(): string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): self
    {
        $this->lastName = $lastName;

        return $this;
    }

    public function getGender(): string
    {
        return $this->gender;
    }

    public function setGender(string $gender): self
    {
        if (!$this->isValidGenderType($gender)) {
            throw new InvalidArgumentException('Invalid gender type');
        }
        $this->gender = $gender;

        return $this;
    }

    private function isValidGenderType(string $genderType): bool
    {
        if ('male' === $genderType || 'female' === $genderType) {
            return true;
        }

        return false;
    }

    public function getDateOfBirth(): ?\DateTimeImmutable
    {
        return $this->dateOfBirth;
    }

    public function setDateOfBirth(\DateTimeImmutable $dateOfBirth): void
    {
        $this->dateOfBirth = $dateOfBirth;
    }
}
