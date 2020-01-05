<?php

declare(strict_types=1);

namespace App\Dto;

use App\Entity\Patient;
use Symfony\Component\Validator\Constraints as Assert;

class PatientPersonalDataDTO
{
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

    /** @var \DateTimeImmutable */
    public $dateOfBirth;

    public static function fromPatient(Patient $patient): self
    {
        $dto = new self();
        $dto->firstName = $patient->getFirstname();
        $dto->middleName = $patient->getMiddleName();
        $dto->lastName = $patient->getLastName();
        $dto->dateOfBirth = $patient->getDateOfBirth();

        return $dto;
    }
}
