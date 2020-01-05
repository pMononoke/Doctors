<?php

declare(strict_types=1);

namespace App\Tests\Unit\Entity;

use App\Entity\Metadata;
use App\Entity\Test;
use PHPUnit\Framework\TestCase;

class MetadataTest extends TestCase
{
    /** @test */
    public function can_be_created(): void
    {
        $metadata = new Metadata();

        self::assertInstanceOf(Metadata::class, $metadata);
        self::assertNull($metadata->getId());
    }

    /** @test */
    public function a_Key_value_can_be_added(): void
    {
        $metadata = new Metadata();

        $metadata->setThekey('irrelevant');

        self::assertEquals('irrelevant', $metadata->getThekey());
    }

    /** @test */
    public function a_Value_of_Key_value_can_be_added(): void
    {
        $metadata = new Metadata();

        $metadata->setThevalue('irrelevant');

        self::assertEquals('irrelevant', $metadata->getThevalue());
    }

    /** @test */
    public function a_Test_can_be_added(): void
    {
        $testEntity = new Test();
        $metadata = new Metadata();

        $metadata->setTest($testEntity);

        self::assertEquals($testEntity, $metadata->getTest());
    }
}
