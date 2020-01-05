<?php

declare(strict_types=1);

namespace App\Tests\Integration\Service;

use App\Dto\RegisterUserDTO;
use App\Dto\UserDTO;
use App\Dto\UserProfileDTO;
use App\Entity\User;
use App\Service\UserService;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class UserServiceTest extends KernelTestCase
{
    private const IRRELEVANT_STRING = 'irrelevant';

    /** @var UserService */
    private $userService;

    /** var UserRepository */
    private $userRepository;

    protected function setUp()/* The :void return type declaration that should be here would cause a BC issue */
    {
        parent::setUp();
        self::bootKernel();
        $this->userService = self::$container->get('test.App\Service\UserService');
        $this->userRepository = self::$container->get('test.App\Repository\UserRepository');
    }

    /** @test */
    public function can_register_a_user_from_dto_data(): void
    {
        $user = $this->createRegisterUserDto();

        $this->userService->registerUserByAdminWithDtoData($user);

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

    private function createUser(): User
    {
        $user = new User();
        $user->setEmail(self::IRRELEVANT_STRING.'@example.com');
        $user->setPassword(self::IRRELEVANT_STRING);

        return $user;
    }

    private function createRegisterUserDto(): RegisterUserDTO
    {
        $userDTO = new UserDTO();
        $userDTO->email = self::IRRELEVANT_STRING.'@example.com';
        $userDTO->password = self::IRRELEVANT_STRING;
        $userDTO->roles = ['ROLE_USER'];
        $profileDTO = new UserProfileDTO();
        $profileDTO->firstName = self::IRRELEVANT_STRING;
        $profileDTO->lastName = self::IRRELEVANT_STRING;

        $registerUserDTO = new RegisterUserDTO();
        $registerUserDTO->user = $userDTO;
        $registerUserDTO->profile = $profileDTO;

        return $registerUserDTO;
    }

    protected function tearDown(): void
    {
        $this->userService = null;
        $this->userRepository = null;
        parent::tearDown();
    }
}
