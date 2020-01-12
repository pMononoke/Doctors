<?php

declare(strict_types=1);

namespace App\Tests\Integration\Persistence\Entitiy\Doctrine;

use App\Entity\User;

class UserTest extends EntityTestCase
{
    /**
     * @var string
     */
    protected $entityName = User::class;
}
