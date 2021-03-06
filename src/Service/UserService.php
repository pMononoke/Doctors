<?php

declare(strict_types=1);

namespace App\Service;

use App\Entity\User;
use App\Entity\UserId;
use App\Entity\UserRepository;
use App\Form\User\Dto\ChangeUserPasswordDTO;
use App\Form\User\Dto\UserDTO;
use Psr\Log\LoggerInterface;
use RuntimeException;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserService
{
    /** @var UserRepository */
    private $userRepository;

    /** @var PasswordGenerator */
    private $passwordGenerator;

    /** @var UserPasswordEncoderInterface */
    private $passwordEncoder;

    /** @var LoggerInterface */
    private $logger;

    public function __construct(UserRepository $userRepository, PasswordGenerator $passwordGenerator, UserPasswordEncoderInterface $passwordEncoder, LoggerInterface $logger)
    {
        $this->userRepository = $userRepository;
        $this->passwordGenerator = $passwordGenerator;
        $this->passwordEncoder = $passwordEncoder;
        $this->logger = $logger;
    }

    public function registerUserByAdminWithDtoData(UserDTO $registerUserDTO): void
    {
        $user = new User();
        $user->setEmail($registerUserDTO->email);
        $generatedPassword = $this->passwordGenerator->generatepassword();
        $user->setPassword($this->passwordEncoder->encodePassword($user, $generatedPassword));
        $user->setRoles(['ROLE_USER']);
        $user->setAccountStatus($registerUserDTO->accountStatus);
        $user->setFirstName($registerUserDTO->firstName);
        $user->setLastName($registerUserDTO->lastName);

        $this->userRepository->save($user);
    }

    public function changePassword(ChangeUserPasswordDTO $changeUserPasswordDTO): void
    {
        if (!$user = $this->userRepository->ofId($changeUserPasswordDTO->id)) {
            throw new RuntimeException('User not found');
        }

        $user->setPassword($this->passwordEncoder->encodePassword($user, $changeUserPasswordDTO->plainPassword));

        $this->userRepository->update($user);
    }

    public function enableAccount(UserId $userId): void
    {
        if (!$user = $this->userRepository->ofId($userId)) {
            throw new RuntimeException('User not found');
        }

        $user->setAccountStatus(true);

        $this->userRepository->update($user);
    }

    public function disableAccount(UserId $userId): void
    {
        if (!$user = $this->userRepository->ofId($userId)) {
            throw new RuntimeException('User not found');
        }

        $user->setAccountStatus(false);

        $this->userRepository->update($user);
    }

    public function update(User $user): void
    {
        $this->userRepository->update($user);
    }

    public function delete(User $user): void
    {
        $this->userRepository->delete($user);
    }
}
