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
            ->withEnabledAccount()
            ->withRoles(['ROLE_USER'])
            ->withEmail('irrelevant@example.com');

        return $builder->build();
    }

    public function createAdminUser(): User
    {
        /** @var UserBuilder $builder */
        $builder = UserBuilder::create()
            ->withEnabledAccount()
            ->withRoles(['ROLE_ADMIN'])
            ->withEmail('admin@example.com');

        return $builder->build();
    }

    public function createPhysicianUser(): User
    {
        /** @var UserBuilder $builder */
        $builder = UserBuilder::create()
            ->withEnabledAccount()
            ->withRoles(['ROLE_PHYSICIAN'])
            ->withEmail('physician@example.com');

        return $builder->build();
    }
}
