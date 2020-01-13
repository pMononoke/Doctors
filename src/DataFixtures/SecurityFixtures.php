<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class SecurityFixtures extends Fixture
{
    private const DEVELOP_ADMIN_PASSWORD = 'admin';
    private const DEVELOP_USER_PASSWORD = 'user';
    /**
     * @var UserPasswordEncoderInterface
     */
    private $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    public function load(ObjectManager $manager)
    {
        $adminUser = new User();
        $adminUser->setEmail('admin@example.com');
        $adminUser->setPassword($this->passwordEncoder->encodePassword($adminUser, self::DEVELOP_ADMIN_PASSWORD));
        $adminUser->setRoles(['ROLE_ADMIN']);
        $adminUser->setAccountStatus(true);
        $manager->persist($adminUser);
        $manager->flush();

        $user = new User();
        $user->setEmail('user@example.com');
        $user->setPassword($this->passwordEncoder->encodePassword($user, self::DEVELOP_USER_PASSWORD));
        $user->setRoles(['ROLE_USER']);
        $user->setAccountStatus(true);
        $manager->persist($user);
        $manager->flush();
    }
}
