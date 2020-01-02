<?php

declare(strict_types=1);

namespace App\Service;

use App\Entity\Patient;
use App\Entity\PatientRepository;
use App\Entity\Person;
use Doctrine\ORM\EntityManagerInterface;
use Psr\Log\LoggerInterface;

class PatientService
{
    /** @var EntityManagerInterface */
    private $entityManager;

    /** @var LoggerInterface */
    private $logger;

    /** @var PatientRepository */
    private $patientRepository;

    public function __construct(PatientRepository $patientRepository, EntityManagerInterface $entityManager, LoggerInterface $logger)
    {
        $this->patientRepository = $patientRepository;
        $this->entityManager = $entityManager;
        $this->logger = $logger;
    }

//    public function RegisterPatient(Person $person): void
//    {
//        $this->save($person);
//    }
    public function RegisterPatient(Patient $patient): void
    {
        $this->patientRepository->save($patient);
    }

    private function save(Person $person): void
    {
        $this->entityManager->persist($person);
        $this->entityManager->flush();
    }

//    public function update(Person $person): void
//    {
//        $this->save($person);
//    }

    public function update(Patient $patient): void
    {
        $this->patientRepository->update($patient);
    }

    public function delete(Patient $patient): void
    {
        $this->patientRepository->delete($patient);
    }
}
