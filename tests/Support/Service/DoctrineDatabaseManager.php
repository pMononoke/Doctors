<?php

declare(strict_types=1);

namespace App\Tests\Support\Service;

use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Mapping\ClassMetadata;

class DoctrineDatabaseManager
{
    /** @var EntityManagerInterface */
    private $entityManager;

    /**
     * DoctrineDatabaseManager constructor.
     */
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function setUp(): void
    {
        $this->truncateTables();
    }

    private function truncateTables(): void
    {
        $metaData = $this->entityManager->getMetadataFactory()->getAllMetadata();

        $this->entityManager->getConnection()->executeQuery('SET FOREIGN_KEY_CHECKS = 0;');
        /** @var ClassMetadata $meta */
        foreach ($metaData as $meta) {
            //$this->entityManager->getConnection()->executeQuery(sprintf('TRUNCATE "%s" CASCADE;', $meta->getTableName()));
            $this->entityManager->getConnection()->executeQuery(sprintf('TRUNCATE %s ;', $meta->getTableName()));
        }
        $this->entityManager->getConnection()->executeQuery('SET FOREIGN_KEY_CHECKS = 1;');
    }

    private function save($object)
    {
        $this->entityManager->persist($object);
        $this->entityManager->flush();

        return $object;
    }
}
