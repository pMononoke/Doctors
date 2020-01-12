<?php

declare(strict_types=1);

namespace App\Form\Patient\Dto;

use Symfony\Component\Validator\Constraints as Assert;

class RegisterPatientDTO
{
    /**
     * @Assert\Valid()
     *
     * @var PatientPersonalDataDTO
     */
    public $patientPersonalData;
}
