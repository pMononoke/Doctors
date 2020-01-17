<?php

declare(strict_types=1);

namespace App\Tests\Support\Fixtures;

use App\Entity\User;
use App\Tests\Support\Builder\UserBuilder;

trait UserFixturesBehaviorTrait
{
    public function createIrrelevantUser(): User
    {
        /** @var UserBuilder $builder */
        $builder = UserBuilder::create()
            ->withEnabledAccount();

        return $builder->build();
    }

    public function createAdminUser(): User
    {
        /** @var UserBuilder $builder */
        $builder = UserBuilder::create()
            ->withEnabledAccount()
            //TODO set role admin
            ->withEmail('admin@example.com');

        return $builder->build();
    }

    public function createPhysicianUser(): User
    {
        /** @var UserBuilder $builder */
        $builder = UserBuilder::create()
            ->withEnabledAccount()
            //TODO set role physician
            ->withEmail('admin@example.com');

        return $builder->build();
    }

    public function createMultipleIrrelevantUser(int $numberOfUsers = 0): User
    {
        //TODO
        //$builder = UserBuilder::create();
    }
}
