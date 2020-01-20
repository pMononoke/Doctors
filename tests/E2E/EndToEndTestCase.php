<?php

declare(strict_types=1);

namespace App\Tests\E2E;

use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\Panther\PantherTestCase;

abstract class EndToEndTestCase extends PantherTestCase
{
    /**
     * @var ContainerInterface|null
     */
    private $containerTest;

    protected function setUp(): void
    {
        self::bootKernel();
        $this->containerTest = self::$container;
        $this->persistenceManager()->loadDataFixtures();
        parent::setUp();
    }

    protected function persistenceManager(): PersistenceDatabaseManager
    {
        return $this->getContainer()->get('test.persistence_manager');
    }

    protected function getContainer(): ContainerInterface
    {
        return $this->containerTest;
    }

    protected function tearDown(): void
    {
        $this->containerTest = null;
        parent::tearDown();
    }
}
