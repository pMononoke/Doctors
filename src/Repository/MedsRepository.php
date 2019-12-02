<?php

namespace App\Repository;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Tools\Pagination\Paginator;


class MedsRepository extends EntityRepository
{
    /* advanced search */
    public function search($searchParam) {
        extract($searchParam);        
        $qb = $this->createQueryBuilder('m');

        if(!empty($keyword))
            $qb->andWhere('m.name like :keyword or m.type like :keyword or m.about like :keyword')
                ->setParameter('keyword', '%'.$keyword.'%');
        if(!empty($ids))
            $qb->andWhere('m.id in (:ids)')->setParameter('ids', $ids);
        if(!empty($sortBy)){
            $sortBy = in_array($sortBy, array('name', 'type', 'count', 'expdate')) ? $sortBy : 'id';
            $sortDir = ($sortDir == 'DESC') ? 'DESC' : 'ASC';
            $qb->orderBy('m.' . $sortBy, $sortDir);
        }
        if(!empty($perPage)) $qb->setFirstResult(($page - 1) * $perPage)->setMaxResults($perPage);

       return new Paginator($qb->getQuery());
    }

    public function counter() {
        $qb = $this->createQueryBuilder('m')->select('COUNT(m)');
        return $qb->getQuery()->getSingleScalarResult();
    }
}
