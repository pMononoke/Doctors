<?php

namespace App\Repository;

use App\Entity\Patient;
use App\Entity\PatientId;
use App\Entity\PatientRepository as PatientRepositoryPort;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Patient|null find($id, $lockMode = null, $lockVersion = null)
 * @method Patient|null findOneBy(array $criteria, array $orderBy = null)
 * @method Patient[]    findAll()
 * @method Patient[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PatientRepository extends ServiceEntityRepository implements PatientRepositoryPort
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Patient::class);
    }

    public function save(Patient $patient): void
    {
        // TODO: check if exist throw exception if exist
        $patient = $this->touch($patient);
        $this->_em->persist($patient);
        $this->_em->flush();
    }

    public function update(Patient $patient): void
    {
        // TODO: check if exist throw exception if not exist
        $patient = $this->touch($patient);
        $this->_em->persist($patient);
        $this->_em->flush();
    }

    public function delete(Patient $patient): void
    {
        $this->_em->remove($patient);
        $this->_em->flush();
    }

    public function nextIdentity(): PatientId
    {
        return PatientId::generate();
    }

    private function touch(Patient $patient): Patient
    {
        $now = new \DateTimeImmutable('now');
        if (!$patient->getCreatedAt()) {
            $patient->setCreatedAt($now);
            $patient->setUpdatedAt($now);

            return $patient;
        }

        $patient->setUpdatedAt($now);

        return $patient;
    }

    public function findByUuidString(string $uuid): ?Patient
    {
        $patietId = PatientId::fromString($uuid);

        return $this->createQueryBuilder('p')
            ->andWhere('p.id = :patientId')
            ->setParameter('patientId', $patietId)
            ->getQuery()
            ->getOneOrNullResult()
            ;
    }
}
