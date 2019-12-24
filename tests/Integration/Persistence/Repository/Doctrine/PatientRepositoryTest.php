<?php

declare(strict_types=1);

namespace App\Tests\Integration\Persistence\Repository\Doctrine;

use App\Entity\PatientRepository;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class PatientRepositoryTest extends KernelTestCase
{
    /** @var mixed|PatientRepository */
    private $repository;

    protected function setUp(): void
    {
        parent::setUp();
        self::bootKernel();
        $this->repository = self::$container->get('test.App\Repository\PatientRepository');
    }

    protected function tearDown(): void
    {
        $this->repository = null;
        parent::tearDown();
    }
}
