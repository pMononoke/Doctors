<?php

declare(strict_types=1);

namespace App\Tests\Integration\Persistence\Entitiy\Doctrine;

use App\Entity\Metadata;

class MetadataTest extends EntityTestCase
{
    /**
     * @var string
     */
    protected $entityName = Metadata::class;
}
