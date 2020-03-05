<?php

namespace App\Repository;

use App\Entity\Disease;
use App\Entity\DiseaseRepository as DiseasesRepositoryPort;
use App\Entity\Patient;
use App\Entity\PatientId;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Disease|null find($id, $lockMode = null, $lockVersion = null)
 * @method Disease|null findOneBy(array $criteria, array $orderBy = null)
 * @method Disease[]    findAll()
 * @method Disease[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DiseaseRepository extends ServiceEntityRepository implements DiseasesRepositoryPort
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Disease::class);
    }

//    public function nextIdentity(): PatientId
//    {
//        return PatientId::generate();
//    }

//    public function findByUuidString(string $uuid): ?Patient
//    {
//        $patietId = PatientId::fromString($uuid);
//
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.id = :patientId')
//            ->setParameter('patientId', $patietId)
//            ->getQuery()
//            ->getOneOrNullResult()
//            ;
//    }

    public function save(Disease $diseases): void
    {
        $this->_em->persist($diseases);
        $this->_em->flush();
    }

    public function update(Disease $diseases): void
    {
        $this->_em->persist($diseases);
        $this->_em->flush();
    }

    public function delete(Disease $diseases): void
    {
        $this->_em->remove($diseases);
        $this->_em->flush();
    }
}
