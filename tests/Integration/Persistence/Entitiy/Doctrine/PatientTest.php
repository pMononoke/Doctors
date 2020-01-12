<?php

declare(strict_types=1);

namespace App\Tests\Integration\Persistence\Entitiy\Doctrine;

use App\Entity\Patient;

class PatientTest extends EntityTestCase
{
    /**
     * @var string
     */
    protected $entityName = Patient::class;
}
