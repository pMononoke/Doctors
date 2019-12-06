<?php

declare(strict_types=1);

namespace App\Service;

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

    public function RegisterPatient(Person $person): void
    {
        $this->save($person);
        //$this->addFlash('success', 'patient.created');
    }

    // Todo make private
    public function save(Person $person): void
    {
        $this->entityManager->persist($person);
        $this->entityManager->flush();
    }

    public function update(Person $person): void
    {
        $this->save($person);
        //$this->addFlash('success', 'message.updated');
    }
}
