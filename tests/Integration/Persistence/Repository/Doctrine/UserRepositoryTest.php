<?php

declare(strict_types=1);

namespace App\Tests\Integration\Persistence\Repository\Doctrine;

use App\Entity\User;
use App\Entity\UserId;
use App\Entity\UserRepository;
use App\Tests\Support\TestCase\DatabaseTestCase;

class UserRepositoryTest extends DatabaseTestCase
{
    private const IRRELEVANT_STRING = 'irrelevant';

    /** @var mixed|UserRepository */
    private $repository;

    protected function setUp(): void
    {
        self::bootKernel();
        $this->repository = self::$container->get('test.App\Repository\UserRepository');
        parent::setUp();
    }

    /** @test */
    public function can_persist_a_user(): void
    {
        $newUser = $this->createUser();
        $this->repository->save($newUser);

        /** @var User $userFromDatabase */
        $userFromDatabase = $this->find(User::class, $newUser->getId());
        self::assertEquals(1, $this->countItem(User::class));
        self::assertEquals($newUser->getEmail(), $userFromDatabase->getEmail());
    }

    /** @test */
    public function can_persist_multiple_users(): void
    {
        $firstUser = $this->createUser();
        $secondUser = $this->createUser();
        $thridUser = $this->createUser();

        $this->repository->save($firstUser);
        $this->repository->save($secondUser);
        $this->repository->save($thridUser);

        self::assertEquals(3, $this->countItem(User::class));
    }

    /** @test */
    public function can_update_a_user(): void
    {
        $newUser = $this->createUser();
        $this->databaseManager()->save($newUser);

        $newUser->setEmail('new-email@example.com');
        $this->repository->update($newUser);

        /** @var User $userFromDatabase */
        $userFromDatabase = $this->find(User::class, $newUser->getId());
        self::assertEquals(1, $this->countItem(User::class));
        self::assertEquals('new-email@example.com', $userFromDatabase->getEmail());
    }

    /** @test */
    public function can_delete_a_user(): void
    {
        $newUser = $this->createUser();
        $this->databaseManager()->save($newUser);
        self::assertEquals(1, $this->countItem(User::class));

        $this->repository->delete($newUser);
        self::assertEquals(0, $this->countItem(User::class));
    }

    /** @test */
    public function can_generate_a_new_identity_for_user(): void
    {
        $identity = $this->repository->nextIdentity();

        self::assertInstanceOf(UserId::class, $identity);
    }

    private function createUser(): User
    {
        $user = new User();
        $user->setEmail(self::IRRELEVANT_STRING.$user->getId()->toString().'@example.com');
        $user->setPassword(self::IRRELEVANT_STRING);

        return $user;
    }

    protected function tearDown(): void
    {
        $this->repository = null;
        parent::tearDown();
    }
}
