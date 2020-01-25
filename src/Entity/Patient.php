<?php

declare(strict_types=1);

namespace App\Entity;

use App\Entity\Common\PatientPerson;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PatientRepository")
 */
class Patient
{
    /**
     * @var PatientId
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="NONE")
     * @ORM\Column(type="patientId")
     */
    private $id;

    /**
     * @var PatientPerson
     * @ORM\Embedded(class = "App\Entity\Common\PatientPerson", columnPrefix = false)
     */
    private $person;
    /**
     * @var \DateTimeImmutable
     * @ORM\Column(type="datetimetz_immutable")
     */
    private $createdAt;

    /**
     * @var \DateTimeImmutable
     * @ORM\Column(type="datetimetz_immutable")
     */
    private $updatedAt;

    /**
     * Patient constructor.
     *
     * @param PatientPerson $person
     */
    public function __construct(?PatientId $patientId = null, PatientPerson $person = null)
    {
        $this->id = $patientId ?? PatientId::generate();
        $this->person = $person ?? new PatientPerson();
    }

    public function setId(PatientId $patientId): self
    {
        $this->id = $patientId;

        return $this;
    }

    public function getId(): ?PatientId
    {
        return $this->id;
    }

    public function setFirstName(string $firstName): self
    {
        $this->person = $this->person->setFirstName($firstName);

        return $this;
    }

    public function getFirstName(): ?string
    {
        return $this->person->getFirstName();
    }

    public function setMiddleName(string $middleName): self
    {
        $this->person = $this->person->setMiddleName($middleName);

        return $this;
    }

    public function getMiddleName(): ?string
    {
        return $this->person->getMiddleName();
    }

    public function setLastName(string $lastName): self
    {
        $this->person->setLastName($lastName);

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->person->getLastName();
    }

    public function setGender(string $gender): self
    {
        $this->person->setGender($gender);

        return $this;
    }

    public function getGender(): ?string
    {
        return $this->person->getGender();
    }

    public function getDateOfBirth(): ?\DateTimeImmutable
    {
        return $this->person->getDateOfBirth();
    }

    public function setDateOfBirth(\DateTimeImmutable $dateOfBirth): self
    {
        $this->person->setDateOfBirth($dateOfBirth);

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeImmutable
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(\DateTimeImmutable $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }
}
