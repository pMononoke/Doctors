<?php

declare(strict_types=1);

namespace App\Tests\Integration\Persistence\Repository\Doctrine;

use App\Entity\UserRepository;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class UserRepositoryTest extends KernelTestCase
{
    /** @var UserRepository|null */
    private $repository;

    protected function setUp(): void
    {
        parent::setUp();
        self::bootKernel();
        $this->repository = self::$container->get('test.App\Repository\UserRepository');
    }

    protected function tearDown(): void
    {
        $this->repository = null;
        parent::tearDown();
    }
}
