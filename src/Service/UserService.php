<?php

declare(strict_types=1);

namespace App\Service;

use App\Entity\User;
use App\Entity\UserId;
use App\Entity\UserProfile;
use App\Entity\UserRepository;
use App\Form\User\Dto\ChangeUserPasswordDTO;
use App\Form\User\Dto\RegisterUserDTO;
use Doctrine\ORM\EntityManagerInterface;
use Psr\Log\LoggerInterface;
use RuntimeException;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserService
{
    /** @var EntityManagerInterface */
    private $entityManager;

    /** @var UserRepository */
    private $userRepository;

    /** @var LoggerInterface */
    private $logger;

    /** @var UserPasswordEncoderInterface */
    private $passwordEncoder;

    public function __construct(UserRepository $userRepository, EntityManagerInterface $entityManager, LoggerInterface $logger, UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->userRepository = $userRepository;
        $this->entityManager = $entityManager;
        $this->logger = $logger;
        $this->passwordEncoder = $passwordEncoder;
    }

    public function registerUserByAdminWithDtoData(RegisterUserDTO $registerUserDTO): void
    {
        $profile = new UserProfile();
        $profile->setFirstName($registerUserDTO->profile->firstName);
        $profile->setLastName($registerUserDTO->profile->lastName);

        $user = new User();
        // TODO use a random password generator
        $generatedPassword = 'random';

        $user->setEmail($registerUserDTO->user->email);
        $user->setPassword($this->passwordEncoder->encodePassword($user, $generatedPassword));
        $user->setRoles(['ROLE_USER']);
        $user->setProfile($profile);

        $this->userRepository->save($user);
    }

    public function changePassword(ChangeUserPasswordDTO $changeUserPasswordDTO): void
    {
        if (!$user = $this->userRepository->ofId($changeUserPasswordDTO->id)) {
            //TODO custom exception
            throw new RuntimeException('User not found');
        }

        $user->setPassword($this->passwordEncoder->encodePassword($user, $changeUserPasswordDTO->plainPassword));

        $this->userRepository->update($user);
    }

    public function enableAccount(UserId $userId): void
    {
        if (!$user = $this->userRepository->ofId($userId)) {
            //TODO custom exception
            throw new RuntimeException('User not found');
        }

        $user->setAccountStatus(true);

        $this->userRepository->update($user);
    }

    public function disableAccount(UserId $userId): void
    {
        if (!$user = $this->userRepository->ofId($userId)) {
            //TODO custom exception
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
