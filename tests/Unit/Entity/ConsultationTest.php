<?php

declare(strict_types=1);

namespace App\Tests\Unit\Entity;

use App\Entity\Consultation;
use App\Entity\ConsultationMeds;
use App\Entity\Person;
use App\Entity\Test;
use App\Entity\User;
use Doctrine\Common\Collections\ArrayCollection;
use PHPUnit\Framework\TestCase;

class ConsultationTest extends TestCase
{
    /** @test */
    public function can_be_created(): void
    {
        $consultation = new Consultation();

        self::assertInstanceOf(Consultation::class, $consultation);
        self::assertNull($consultation->getId());
        self::assertNotNull($consultation->getCreated());
        self::assertEquals($consultation::$GENERAL, $consultation->getType());
        self::assertInstanceOf(ArrayCollection::class, $consultation->getTests());
        self::assertInstanceOf(ArrayCollection::class, $consultation->getConsultationmeds());
    }

    /** @test */
    public function a_Name_value_can_be_added(): void
    {
        $consultation = new Consultation();

        $consultation->setName('irrelevant');

        self::assertEquals('irrelevant', $consultation->getName());
    }

    /** @test */
    public function Created_value_can_be_added(): void
    {
        $consultation = new Consultation();
        $consultation->setCreated($date = new \DateTime('01-01-1970'));

        self::assertEquals($date, $consultation->getCreated());
    }

    /** @test */
    public function a_Person_value_can_be_added(): void
    {
        $person = new Person();
        $consultation = new Consultation();
        $consultation->setPerson($person);

        self::assertEquals($person, $consultation->getPerson());
    }

    /** @test */
    public function a_User_value_can_be_added(): void
    {
        // TODO remove FOSUser add custom user
        self::markTestSkipped('Error: Cannot access parent:: when current class scope has no parent');
        $user = new User();
        $consultation = new Consultation();
        $consultation->setUser($user);

        self::assertEquals($user, $consultation->getUser());
    }

    /** @test */
    public function a_Test_can_be_added_to_collection(): void
    {
        $test = new Test();
        $consultation = new Consultation();
        $consultation->addTest($test);

        self::assertEquals(1, count($consultation->getTests()));
    }

    /** @test */
    public function a_Test_can_be_removed_to_collection(): void
    {
        $test = new Test();
        $consultation = new Consultation();
        $consultation->addTest($test);

        $consultation->removeTest($test);

        self::assertEquals(0, count($consultation->getTests()));
    }

    /** @test */
    public function a_ConsultationMed_can_be_added_to_collection(): void
    {
        $consultationMed = new ConsultationMeds();
        $consultation = new Consultation();
        $consultation->addConsultationmed($consultationMed);

        self::assertEquals(1, count($consultation->getConsultationmeds()));
    }

    /** @test */
    public function a_ConsultationMed_can_be_removed_to_collection(): void
    {
        $consultationMed = new ConsultationMeds();
        $consultation = new Consultation();
        $consultation->addConsultationmed($consultationMed);

        $consultation->removeConsultationmed($consultationMed);

        self::assertEquals(0, count($consultation->getConsultationmeds()));
    }

    /** @test */
    public function a_Diagnosis_value_can_be_added(): void
    {
        $consultation = new Consultation();
        $consultation->setDiagnosis('irrelevant');

        self::assertEquals('irrelevant', $consultation->getDiagnosis());
    }

    /** @test */
    public function a_Treatment_value_can_be_added(): void
    {
        $consultation = new Consultation();
        $consultation->setTreatment('irrelevant');

        self::assertEquals('irrelevant', $consultation->getTreatment());
    }

    /** @test */
    public function a_Type_value_can_be_added(): void
    {
        $consultation = new Consultation();
        $consultation->setType('irrelevant');

        self::assertEquals('irrelevant', $consultation->getType());
    }

    /** @test */
    public function a_MotifType_value_can_be_added(): void
    {
        $consultation = new Consultation();
        $consultation->setMotiftype('irrelevant');

        self::assertEquals('irrelevant', $consultation->getMotiftype());
    }

    /** @test */
    public function a_Infrastructure_value_can_be_added(): void
    {
        $consultation = new Consultation();
        $consultation->setInfrastructure('irrelevant');

        self::assertEquals('irrelevant', $consultation->getInfrastructure());
    }

    /** @test */
    public function if_isSpecial_retun_true(): void
    {
        $consultation = new Consultation();
        $consultation->setType($consultation::$SPECIAL);

        self::assertTrue($consultation->isSpecial());
    }

    /** @test */
    public function if_not_special_method_isSpecial_retun_false(): void
    {
        $consultation = new Consultation();

        self::assertFalse($consultation->isSpecial());
    }

    /** @test */
    public function a_Chronic_value_can_be_added(): void
    {
        $consultation = new Consultation();
        $consultation->setChronic(true);

        self::assertTrue($consultation->getChronic());
    }

    /** @test */
    public function a_Decision_value_can_be_added(): void
    {
        $consultation = new Consultation();
        $consultation->setDecision('irrelevant');

        self::assertEquals('irrelevant', $consultation->getDecision());
    }
}
