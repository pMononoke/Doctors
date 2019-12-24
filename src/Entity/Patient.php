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
    // TODO $id should be uuid type
    // @ORM\Column(type="guid")

    /**
     * @var int
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
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
    public function __construct(PatientPerson $person = null)
    {
        $this->person = $person ?? new PatientPerson();
    }

    public function getId(): ?int
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
