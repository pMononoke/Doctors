<?php

declare(strict_types=1);

namespace App\Tests\Integration\Persistence\Entitiy\Doctrine;

use App\Entity\Person;

class PersonTest extends EntityTestCase
{
    /**
     * @var string
     */
    protected $entityName = Person::class;
}
