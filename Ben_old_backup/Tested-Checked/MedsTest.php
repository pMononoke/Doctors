<?php

declare(strict_types=1);

namespace App\Tests\Integration\Persistence\Entitiy\Doctrine;

use App\Entity\Meds;

class MedsTest extends EntityTestCase
{
    /**
     * @var string
     */
    protected $entityName = Meds::class;
}
