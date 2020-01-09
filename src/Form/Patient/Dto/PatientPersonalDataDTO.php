<?php

declare(strict_types=1);

namespace App\Form\Patient\Dto;

use App\Entity\Patient;
use App\Entity\PatientId;
use Symfony\Component\Validator\Constraints as Assert;

class PatientPersonalDataDTO
{
    /** @var PatientId */
    public $id;
    /**
     * @Assert\NotBlank()
     * @Assert\Length(min="1", max="100")
     *
     * @var string
     */
    public $firstName;

    /**
     * @var string
     */
    public $middleName;

    /**
     * @Assert\NotBlank()
     * @Assert\Length(min="1", max="100")
     *
     * @var string
     */
    public $lastName;

    /**
     * @Assert\NotBlank()
     *
     * @var string
     */
    public $gender;

    /** @var \DateTimeImmutable */
    public $dateOfBirth;

    public static function fromPatient(Patient $patient): self
    {
        $dto = new self();
        $dto->firstName = $patient->getFirstname();
        $dto->middleName = $patient->getMiddleName();
        $dto->lastName = $patient->getLastName();
        $dto->gender = $patient->getGender();
        $dto->dateOfBirth = $patient->getDateOfBirth();

        return $dto;
    }
}
