<?php

declare(strict_types=1);

namespace App\Tests\Unit\Entity;

use App\Entity\Consultation;
use App\Entity\ConsultationMeds;
use App\Entity\Meds;
use Doctrine\Common\Collections\ArrayCollection;
use PHPUnit\Framework\TestCase;

class ConsultationMedsTest extends TestCase
{
    /** @test */
    public function can_be_created(): void
    {
        $consultationMeds = new ConsultationMeds();

        self::assertInstanceOf(ConsultationMeds::class, $consultationMeds);
        self::assertNull($consultationMeds->getId());
        // TODO issue #7
        //self::assertInstanceOf(ArrayCollection::class, $consultationMeds->getConsultation());
    }

    /** @test */
    public function a_Count_value_can_be_added(): void
    {
        $consultationMeds = new ConsultationMeds();

        $consultationMeds->setCount(10);

        self::assertEquals(10, $consultationMeds->getCount());
    }


    /** @test */
    public function a_Consultation_value_can_be_added(): void
    {
        $consultation = new Consultation();
        $consultationMeds = new ConsultationMeds();

        $consultationMeds->setConsultation($consultation);

        self::assertEquals($consultation, $consultationMeds->getConsultation());
    }

    /** @test */
    public function a_Meds_value_can_be_added(): void
    {
        $meds = new Meds();
        $consultationMeds = new ConsultationMeds();

        $consultationMeds->setMeds($meds);

        self::assertEquals($meds, $consultationMeds->getMeds());
    }

    /** @test */
    public function doctrine_pre_remove_callback_update_meds(): void
    {
        self::markTestSkipped();
    }
}
