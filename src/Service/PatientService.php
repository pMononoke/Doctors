<?php

declare(strict_types=1);

namespace App\Service;

use App\Entity\Patient;
use App\Entity\PatientId;
use App\Entity\PatientRepository;
use App\Form\Patient\Dto\RegisterPatientDTO;
use Psr\Log\LoggerInterface;

class PatientService
{
    /** @var LoggerInterface */
    private $logger;

    /** @var PatientRepository */
    private $patientRepository;

    public function __construct(PatientRepository $patientRepository, LoggerInterface $logger)
    {
        $this->patientRepository = $patientRepository;
        $this->logger = $logger;
    }

    public function RegisterPatient(Patient $patient): void
    {
        $this->patientRepository->save($patient);
    }

    public function RegisterPatientWithData(PatientId $patientId, RegisterPatientDTO $registerPatientDTO): void
    {
        $patientPersonalDataDTO = $registerPatientDTO->patientPersonalData;
        $patient = new Patient();
        $patient->setId($patientId);
        $patient->setFirstname($patientPersonalDataDTO->firstName);
        '' === $patientPersonalDataDTO->middleName ? $patient->setMiddleName('') : $patient->setMiddleName($patientPersonalDataDTO->middleName);
        $patient->setLastName($patientPersonalDataDTO->lastName);
        $patient->setGender($patientPersonalDataDTO->gender);
        $patient->setDateOfBirth($patientPersonalDataDTO->dateOfBirth);

        $this->save($patient);
    }

    public function generateNewIdentity(): PatientId
    {
        return $this->patientRepository->nextIdentity();
    }

    private function save(Patient $patient): void
    {
        $this->patientRepository->save($patient);
    }

    public function update(Patient $patient): void
    {
        $this->patientRepository->update($patient);
    }

    public function delete(Patient $patient): void
    {
        $this->patientRepository->delete($patient);
    }
}
