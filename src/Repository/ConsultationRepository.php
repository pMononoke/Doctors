<?php

namespace App\Repository;

use App\Entity\Consultation;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\ORM\Tools\Pagination\Paginator;

class ConsultationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Consultation::class);
    }

    /* advanced search */
    public function search($searchParam)
    {
        extract($searchParam);
        $qb = $this->createQueryBuilder('c')
                ->leftJoin('c.person', 'p')
                ->addSelect('p')
                ->leftJoin('c.user', 'u')
                ->addSelect('u');

        if (!empty($keyword)) {
            $qb->andWhere('concat(p.familyname, p.firstname) like :keyword or p.email like :keyword or c.name like :keyword')
                ->setParameter('keyword', '%'.$keyword.'%');
        }
        if (!empty($ids)) {
            $qb->andWhere('c.id in (:ids)')->setParameter('ids', $ids);
        }
        if (!empty($type)) {
            $qb->andWhere('c.type like :type')->setParameter('type', $type);
        }
        if (!empty($cin)) {
            $qb->andWhere('p.cin = :cin')->setParameter('cin', $cin);
        }
        if (!empty($user)) {
            $qb->andWhere('u.id = :user')->setParameter('user', $user);
        }
        if (!empty($gender)) {
            $qb->andWhere('p.gender = :gender')->setParameter('gender', $gender);
        }
        if (!empty($date)) {
            $qb->andWhere('p.created = :date')->setParameter('date', $date);
        }
        if (!empty($sortBy)) {
            $sortBy = in_array($sortBy, ['firstname', 'familyname', 'birthday']) ? $sortBy : 'id';
            $sortDir = ('DESC' == $sortDir) ? 'DESC' : 'ASC';
            $qb->orderBy('p.'.$sortBy, $sortDir);
        }
        if (!empty($perPage)) {
            $qb->setFirstResult(($page - 1) * $perPage)->setMaxResults($perPage);
        }

        return new Paginator($qb->getQuery());
    }

    public function counter()
    {
        $qb = $this->createQueryBuilder('c')->select('COUNT(c)');

        return $qb->getQuery()->getSingleScalarResult();
    }
}
