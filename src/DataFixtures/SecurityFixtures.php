<?php

namespace App\DataFixtures;

use App\Entity\User;
use App\Tests\Support\Fixtures\UserFixturesBehaviorTrait;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class SecurityFixtures extends Fixture implements FixtureGroupInterface
{
    use UserFixturesBehaviorTrait;

    private const DEVELOP_ADMIN_PASSWORD = 'admin';
    private const DEVELOP_PHYSICIAN_PASSWORD = 'physician';
    private const DEVELOP_USER_PASSWORD = 'user';
    /**
     * @var UserPasswordEncoderInterface
     */
    private $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    public function load(ObjectManager $manager): void
    {
        $adminUser = $this->adminUser();
        $manager->persist($adminUser);
        $manager->flush();

        $physicianUser = $this->physicianUser();
        $manager->persist($physicianUser);
        $manager->flush();
    }

    private function adminUser(): User
    {
        $adminUser = $this->createAdminUser();
        $adminUser->setPassword($this->passwordEncoder->encodePassword($adminUser, self::DEVELOP_ADMIN_PASSWORD));

        return $adminUser;
    }

    private function physicianUser(): User
    {
        $physicianUser = $this->createPhysicianUser();
        $physicianUser->setPassword($this->passwordEncoder->encodePassword($physicianUser, self::DEVELOP_PHYSICIAN_PASSWORD));

        return $physicianUser;
    }

    /**
     * This method must return an array of groups
     * on which the implementing class belongs to.
     *
     * @return string[]
     */
    public static function getGroups(): array
    {
        return ['e2e', 'panther'];
    }
}
