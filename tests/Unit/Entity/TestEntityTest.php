<?php

declare(strict_types=1);

namespace App\Tests\Unit\Entity;

use App\Entity\Consultation;
use App\Entity\Test;
use PHPUnit\Framework\TestCase;

class TestEntityTest extends TestCase
{
    /** @test */
    public function can_be_created(): void
    {
        $test = new Test();

        self::assertInstanceOf(Test::class, $test);
        self::assertNull($test->getId());
//        self::assertNotNull($meds->getCreated());
//        self::assertInstanceOf(\DateTime::class, $meds->getCreated());
//        self::assertNotNull($meds->getExpdate());
//        self::assertInstanceOf(\DateTime::class, $meds->getExpdate());
    }

    /** @test */
    public function a_Type_value_can_be_added(): void
    {
        $test = new Test();

        $test->setType('irrelevant');

        self::assertEquals('irrelevant', $test->getType());
    }

    /** @test */
    public function method_isGeneral_return_true_if_type_is_set_general(): void
    {
        $test = new Test();

        $test->setType($test::$GENERAL);

        self::assertTrue($test->isGeneral());
    }

    /** @test */
    public function method_isGeneral_return_false_if_type_is_not_general(): void
    {
        $test = new Test();

        $test->setType('irrelevant');

        self::assertFalse($test->isGeneral());
    }

    /** @test */
    public function a_Consultation_can_be_added(): void
    {
        $consultation = new Consultation();
        $test = new Test();

        $test->setConsultation($consultation);

        self::assertEquals($consultation, $test->getConsultation());
    }

    /** @test */
    public function a_Taille_value_can_be_added(): void
    {
        $test = new Test();

        $test->setTaille('irrelevant');

        self::assertEquals('irrelevant', $test->getTaille());
    }

    /** @test */
    public function a_Poids_value_can_be_added(): void
    {
        $test = new Test();

        $test->setPoids('irrelevant');

        self::assertEquals('irrelevant', $test->getPoids());
    }

    /** @test */
    public function a_Ta_value_can_be_added(): void
    {
        $test = new Test();

        $test->setTa('irrelevant');

        self::assertEquals('irrelevant', $test->getTa());
    }

    /** @test */
    public function a_Od_value_can_be_added(): void
    {
        $test = new Test();

        $test->setOd('irrelevant');

        self::assertEquals('irrelevant', $test->getOd());
    }

    /** @test */
    public function a_Og_value_can_be_added(): void
    {
        $test = new Test();

        $test->setOg('irrelevant');

        self::assertEquals('irrelevant', $test->getOg());
    }

    /** @test */
    public function a_Request_value_can_be_added(): void
    {
        $test = new Test();

        $test->setRequest('irrelevant');

        self::assertEquals('irrelevant', $test->getRequest());
    }

    /** @test */
    public function a_Result_value_can_be_added(): void
    {
        $test = new Test();

        $test->setResult('irrelevant');

        self::assertEquals('irrelevant', $test->getResult());
    }

    /** @test */
    public function a_Hasvisualissue_value_can_be_added(): void
    {
        $test = new Test();

        $test->setHasvisualissue(true);

        self::assertIsBool($test->getHasvisualissue());
    }

    /** @test */
    public function a_Fixedvisualissue_value_can_be_added(): void
    {
        $test = new Test();

        $test->setFixedvisualissue(true);

        self::assertIsBool($test->getFixedvisualissue());
    }
}
