<?php

declare(strict_types=1);

namespace App\Tests\Integration\Persistence\Entitiy\Doctrine;

use App\Entity\Config;

class ConfigEntityTest extends EntityTestCase
{
    /**
     * @var string
     */
    protected $entityName = Config::class;
}
