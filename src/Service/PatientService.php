<?php

declare(strict_types=1);

namespace App\Service;

use App\Dto\PatientDTO;
use App\Entity\Person;
use Doctrine\ORM\EntityManagerInterface;
use Psr\Log\LoggerInterface;

class PatientService
{
    /** @var EntityManagerInterface */
    private $entityManager;

    /** @var LoggerInterface */
    private $logger;

    public function __construct(EntityManagerInterface $entityManager, LoggerInterface $logger)
    {
        $this->entityManager = $entityManager;
        $this->logger = $logger;
    }

    public function RegisterPatient(PatientDTO $patientDTO): void
    {
        $currentDate = new \DateTime('now');

        $person = new Person();
        $person->setFirstname($patientDTO->firstName);
        $person->setFamilyname($patientDTO->lastName);
        $person->setCin($patientDTO->cin);
        $person->setCne($patientDTO->cne);
        $person->setGender($patientDTO->gender);
        $person->setCnss($patientDTO->cnss);
        $person->setCnsstype($patientDTO->cnsstype);
        $person->setResident($patientDTO->resident);

        $person->setCreated($currentDate);

        $this->save($person);
        //$this->addFlash('success', 'patient.created');
    }

    public function save(Person $person): void
    {
        $this->entityManager->persist($person);
        $this->entityManager->flush();
    }
}
