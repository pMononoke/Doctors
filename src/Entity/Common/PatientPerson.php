<?php

declare(strict_types=1);

namespace App\Entity\Common;

use Doctrine\ORM\Mapping as ORM;

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
     * @ORM\Column(type = "string")
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

    public function getFirstName(): string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): void
    {
        $this->firstName = $firstName;
    }

    public function getMiddleName(): string
    {
        return $this->middleName;
    }

    public function setMiddleName(string $middleName): void
    {
        $this->middleName = $middleName;
    }

    public function getLastName(): string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): void
    {
        $this->lastName = $lastName;
    }

    public function getGender(): string
    {
        return $this->gender;
    }

    public function setGender(string $gender): void
    {
        $this->gender = $gender;
    }
}
