<?php

declare(strict_types=1);

namespace App\Service;

use App\Dto\RegisterUserDTO;
use App\Entity\User;
use App\Entity\UserProfile;
use App\Entity\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Psr\Log\LoggerInterface;
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

        //$this->save($user);
        $this->userRepository->save($user);
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
