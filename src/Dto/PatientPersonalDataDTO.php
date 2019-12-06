<?php

declare(strict_types=1);

namespace App\Dto;

use App\Entity\Person;
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
     * @Assert\NotBlank()
     * @Assert\Length(min="1", max="100")
     *
     * @var string
     */
    public $lastName;

    /** @var \DateTime */
    public $dateOfBirthday;

    public static function fromPatient(Person $person): self
    {
        $dto = new self();
        $dto->firstName = $person->getFirstname();
        $dto->lastName = $person->getFamilyname();
        $dto->dateOfBirthday = $person->getBirthday();

        return $dto;
    }
}
