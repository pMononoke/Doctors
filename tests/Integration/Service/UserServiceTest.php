<?php

declare(strict_types=1);

namespace App\Tests\Integration\Service;

use App\Entity\User;
use App\Form\User\Dto\ChangeUserPasswordDTO;
use App\Form\User\Dto\UserDTO;
use App\Service\UserService;
use App\Tests\Support\TestCase\DatabaseTestCase;

class UserServiceTest extends DatabaseTestCase
{
    private const IRRELEVANT_STRING = 'irrelevant';

    /** @var UserService|mixed */
    private $userService;

    /** var UserRepository|null */
    private $userRepository;

    protected function setUp(): void
    {
        self::bootKernel();
        $this->userService = self::$container->get('test.App\Service\UserService');
        $this->userRepository = self::$container->get('test.App\Repository\UserRepository');
        parent::setUp();
    }

    /** @test */
    public function can_register_a_user_from_dto_data(): void
    {
        $user = $this->createRegisterUserDto();

        $this->userService->registerUserByAdminWithDtoData($user);

        self::assertEquals(1, $this->userRepository->countUsers());
    }

    /** @test */
    public function can_change_a_user_password_from_dto_data(): void
    {
        $user = $this->createUser();
        $this->userRepository->save($user);
        self::assertEquals(1, $this->userRepository->countUsers());

        $changeUserPasswordDTO = new ChangeUserPasswordDTO();
        $changeUserPasswordDTO->id = $user->getId();
        $changeUserPasswordDTO->plainPassword = 'pippoxxxx';

        $this->userService->changePassword($changeUserPasswordDTO);

        /** @var User $userFromDatabase */
        $userFromDatabase = $this->find(User::class, $user->getId());

        //TODO it works, but how to assert.
        //self::assertNotEquals($user->getPassword(), $userFromDatabase->getPassword());

        self::assertEquals(1, $this->userRepository->countUsers());
    }

    /** @test */
    public function can_update_a_user(): void
    {
        //TODO fragile test -
        $user = $this->createUser();

        $this->userService->update($user);

        self::assertEquals(1, $this->userRepository->countUsers());
    }

    /** @test */
    public function can_delete_a_user(): void
    {
        $user = $this->createUser();
        $this->userRepository->save($user);
        self::assertEquals(1, $this->userRepository->countUsers());

        $this->userService->delete($user);

        self::assertEquals(0, $this->userRepository->countUsers());
    }

    /** @test */
    public function user_account_can_be_disabled(): void
    {
        $user = $this->createUser();
        $user->setAccountStatus(true);
        $this->userRepository->save($user);
        self::assertEquals(1, $this->userRepository->countUsers());

        $this->userService->disableAccount($user->getId());

        /** @var User $userFromDatabase */
        $userFromDatabase = $this->find(User::class, $user->getId());
        self::assertEquals(1, $this->userRepository->countUsers());
        self::assertFalse($userFromDatabase->isActiveAccount());
    }

    /** @test */
    public function user_account_can_be_enabled(): void
    {
        $user = $this->createUser();
        $user->setAccountStatus(false);
        $this->userRepository->save($user);
        self::assertEquals(1, $this->userRepository->countUsers());

        $this->userService->enableAccount($user->getId());

        /** @var User $userFromDatabase */
        $userFromDatabase = $this->find(User::class, $user->getId());
        self::assertEquals(1, $this->userRepository->countUsers());
        self::assertTrue($userFromDatabase->isActiveAccount());
    }

    private function createUser(): User
    {
        $user = new User();
        $user->setEmail(self::IRRELEVANT_STRING.'@example.com');
        $user->setPassword(self::IRRELEVANT_STRING);

        return $user;
    }

    private function createRegisterUserDto(): UserDTO
    {
        $userDTO = new UserDTO();
        $userDTO->email = self::IRRELEVANT_STRING.'@example.com';
        $userDTO->firstName = self::IRRELEVANT_STRING;
        $userDTO->lastName = self::IRRELEVANT_STRING;
        $userDTO->password = self::IRRELEVANT_STRING;
        $userDTO->roles = ['ROLE_USER'];
        $userDTO->accountStatus = true;

        return $userDTO;
    }

    protected function tearDown(): void
    {
        $this->userService = null;
        $this->userRepository = null;
        parent::tearDown();
    }
}
