<?php

declare(strict_types=1);

namespace App\Service;

use App\Entity\Patient;
use App\Entity\PatientRepository;
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

    public function RegisterPatient(Patient $patient): void
    {
        $this->patientRepository->save($patient);
    }

    private function save(Patient $patient): void
    {
        $this->entityManager->persist($patient);
        $this->entityManager->flush();
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
