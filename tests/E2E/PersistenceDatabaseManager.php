<?php

declare(strict_types=1);

namespace App\Tests\E2E;

use App\DataFixtures\SecurityFixtures;
use DAMA\DoctrineTestBundle\Doctrine\DBAL\StaticDriver;
use Doctrine\Common\DataFixtures\Executor\ORMExecutor;
use Doctrine\Common\DataFixtures\Loader;
use Doctrine\Common\DataFixtures\Purger\ORMPurger;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Mapping\ClassMetadata;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class PersistenceDatabaseManager
{
    /** @var EntityManagerInterface */
    private $entityManager;

    /** @var UserPasswordEncoderInterface */
    private $passwordEncoder;

    /**
     * DoctrineDatabaseManager constructor.
     */
    public function __construct(EntityManagerInterface $entityManager, UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->entityManager = $entityManager;
        $this->passwordEncoder = $passwordEncoder;
    }

//    public function setUp(): void
//    {
//        $this->truncateTables();
//    }

    public function loadDataFixtures(): void
    {
        //StaticDriver::setKeepStaticConnections(false);
        $loader = new Loader();
        foreach ($this->defaultFixtures() as $fixture) {
            $loader->addFixture($fixture);
        }

        $purger = new ORMPurger();
        $purger->setPurgeMode(ORMPurger::PURGE_MODE_DELETE);
        //$purger->setPurgeMode(ORMPurger::PURGE_MODE_TRUNCATE);
        $executor = new ORMExecutor($this->entityManager, $purger);
        //$executor->execute($loader->getFixtures());
        $executor->execute($loader->getFixtures());
        //$executor->execute($loader->getFixtures(), true);
        //StaticDriver::setKeepStaticConnections(true);
    }

    private function defaultFixtures(): iterable
    {
        return [
            new SecurityFixtures($this->passwordEncoder),
        ];
    }

    protected static function setFixtures(): iterable
    {
        return [
//            new SecurityFixtures($encoder),
        ];
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

    public function save($object): object
    {
        $this->entityManager->persist($object);
        $this->entityManager->flush();

        return $object;
    }
}
