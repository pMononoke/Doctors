<?php

declare(strict_types=1);

namespace App\Tests\Integration\Persistence\Entitiy\Doctrine;

use App\Entity\Consultation;

class ConsultationTest extends EntityTestCase
{
    /**
     * @var string
     */
    protected $entityName = Consultation::class;
}
