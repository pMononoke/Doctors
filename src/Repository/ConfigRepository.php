<?php

namespace App\Repository;

use App\Entity\Config;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

class ConfigRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Config::class);
    }

    public function updateBy($key, $value)
    {
        $qB = $this->getEntityManager()->createQueryBuilder()
            ->update('config', 'c')
            ->set('c.theValue', '?1')
            ->where('c.theKey = ?2')
            ->setParameter(1, $value)
            ->setParameter(2, $key);

        return $qB->getQuery()->execute();
    }
}
