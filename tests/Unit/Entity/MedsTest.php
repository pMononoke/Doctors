<?php

declare(strict_types=1);

namespace App\Tests\Unit\Entity;

use App\Entity\ConsultationMeds;
use App\Entity\Meds;
use PHPUnit\Framework\TestCase;

class MedsTest extends TestCase
{
    /** @test */
    public function can_be_created(): void
    {
        $meds = new Meds();

        self::assertInstanceOf(Meds::class, $meds);
        self::assertNull($meds->getId());
        self::assertNotNull($meds->getCreated());
        self::assertInstanceOf(\DateTime::class, $meds->getCreated());
        self::assertNotNull($meds->getExpdate());
        self::assertInstanceOf(\DateTime::class, $meds->getExpdate());
    }

    /** @test */
    public function a_Name_value_can_be_added(): void
    {
        $meds = new Meds();

        $meds->setName('irrelevant');

        self::assertEquals('irrelevant', $meds->getName());
    }

    /** @test */
    public function a_Count_value_can_be_added(): void
    {
        $meds = new Meds();

        $meds->setCount(10);

        self::assertEquals(10, $meds->getCount());
    }

    /** @test */
    public function the_counter_can_be_decremented(): void
    {
        $meds = new Meds();
        $meds->setCount(10);

        $meds->minusCount(2);

        self::assertEquals(8, $meds->getCount());
    }

    /** @test */
    public function a_Type_value_can_be_added(): void
    {
        $meds = new Meds();

        $meds->setType('irrelevant');

        self::assertEquals('irrelevant', $meds->getType());
    }

    /** @test */
    public function a_About_can_be_added(): void
    {
        $meds = new Meds();

        $meds->setAbout('irrelevant');

        self::assertEquals('irrelevant', $meds->getAbout());
    }

    /** @test */
    public function a_ConsultationMed_can_be_added(): void
    {
        $consultationMed = new ConsultationMeds();
        $meds = new Meds();

        $meds->addConsultationmed($consultationMed);

        self::assertEquals(1, count($meds->getConsultationmeds()));
    }

    /** @test */
    public function a_ConsultationMed_can_be_removed(): void
    {
        $consultationMed = new ConsultationMeds();
        $meds = new Meds();
        $meds->addConsultationmed($consultationMed);

        $meds->removeConsultationmed($consultationMed);

        self::assertEquals(0, count($meds->getConsultationmeds()));
    }

    /** @test */
    public function Created_value_can_be_added(): void
    {
        $meds = new Meds();
        $meds->setCreated($date = new \DateTime('01-01-1970'));

        self::assertEquals($date, $meds->getCreated());
    }

    /** @test */
    public function Expdate_value_can_be_added(): void
    {
        $meds = new Meds();
        $meds->setCreated($date = new \DateTime('01-01-1970'));

        self::assertEquals($date, $meds->getCreated());
    }

    /** @test */
    public function IsExpired_method_retur_true_if_expiration_date_is_in_the_past(): void
    {
        $meds = new Meds();
        $meds->setExpdate($date = new \DateTime('01-01-1970'));

        self::assertTrue($meds->isExpired());
    }

    /** @test */
    public function IsExpired_method_return_false_if_expiration_date_is_in_the_past(): void
    {
        $meds = new Meds();
        $meds->setExpdate($date = new \DateTime('01-01-3000'));

        self::assertFalse($meds->isExpired());
    }
}
