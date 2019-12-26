<?php

declare(strict_types=1);

namespace App\Tests\Support\TestCase;

use App\Tests\Support\Service\DoctrineDatabaseManager;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\DependencyInjection\ContainerInterface;

abstract class DatabaseTestCase extends KernelTestCase
{
    /**
     * @var ContainerInterface|null
     */
    private $containerTest;

    /**
     * @param mixed $id
     *
     * @return object|null
     */
    protected function find(string $class, $id)
    {
        return $this->managerForClass($class)->find($class, $id);
    }

    protected function countItem(string $class): int
    {
        return count($this->managerForClass($class)->getRepository($class)->findAll());
    }

    protected function findAll(string $class)
    {
        return $this->managerForClass($class)->getRepository($class)->findAll();
    }

    private function managerForClass(string $class): ObjectManager
    {
        return $this->getContainer()->get('doctrine')->getManagerForClass($class);
    }

    private function databaseSetup(): DoctrineDatabaseManager
    {
        return $this->getContainer()->get('test.database_manager');
    }

    protected function getContainer(): ContainerInterface
    {
        return $this->containerTest;
    }

    /**
     * {@inheritdoc}
     */
    protected function setUp(): void
    {
        //self::bootKernel();
        $this->containerTest = self::$container;
        $this->databaseSetup();
        parent::setUp();
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown(): void
    {
        $this->containerTest = null;
        parent::tearDown();
    }
}
