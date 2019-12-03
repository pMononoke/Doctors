<?php

declare(strict_types=1);

namespace App\Tests\Unit\Entity;

use App\Entity\Person;
use Doctrine\Common\Collections\ArrayCollection;
use PHPUnit\Framework\TestCase;

class PersonTest extends TestCase
{
    /** @test */
    public function can_be_created(): void
    {
        $person = new Person();

        self::assertInstanceOf(Person::class, $person);
        self::assertNull($person->getId());

        //TODO issue #6
        self::assertNotNull($person->getBirthday());

        self::assertNotNull($person->getCreated());
        self::assertInstanceOf(ArrayCollection::class, $person->getAntecedents());
        self::assertInstanceOf(ArrayCollection::class, $person->getConsultations());
    }

    /** @test */
    public function Cin_value_can_be_added(): void
    {
        $person = new Person();
        $person->setCin('irrelevant');

        self::assertEquals('irrelevant', $person->getCin());
    }

    /** @test */
    public function Cne_value_can_be_added(): void
    {
        $person = new Person();
        $person->setCne('irrelevant');

        self::assertEquals('irrelevant', $person->getCne());
    }

    /** @test */
    public function firstName_value_can_be_added(): void
    {
        $person = new Person();
        $person->setFirstname('irrelevant');

        self::assertEquals('irrelevant', $person->getFirstname());
    }

    /** @test */
    public function familyName_value_can_be_added(): void
    {
        $person = new Person();
        $person->setFamilyname('irrelevant');

        self::assertEquals('irrelevant', $person->getFamilyname());
    }

    /** @test */
    public function can_return_the_fullName_of_the_person(): void
    {
        $person = new Person();
        $person->setFirstname('joe');
        $person->setFamilyname('doe');

        self::assertEquals('doe joe', $person->getFullName());
    }

    /** @test */
    public function email_value_can_be_added(): void
    {
        $person = new Person();
        $person->setEmail('irrelevant@example.com');

        self::assertEquals('irrelevant@example.com', $person->getEmail());
    }

    /** @test */
    public function birthday_value_can_be_added(): void
    {
        $person = new Person();
        $person->setBirthday($date = new \DateTime('01-01-1970'));

        self::assertEquals($date, $person->getBirthday());
    }

    /** @test */
    public function birthCity_value_can_be_added(): void
    {
        $person = new Person();
        $person->setBirthcity('irrelevant');

        self::assertEquals('irrelevant', $person->getBirthcity());
    }

    /** @test */
    public function Gender_value_can_be_added(): void
    {
        $person = new Person();
        $person->setGender('irrelevant');

        self::assertEquals('irrelevant', $person->getGender());
    }

    /** @test */
    public function Country_value_can_be_added(): void
    {
        $person = new Person();
        $person->setContry('irrelevant');

        self::assertEquals('irrelevant', $person->getContry());
    }

    /** @test */
    public function City_value_can_be_added(): void
    {
        $person = new Person();
        $person->setCity('irrelevant');

        self::assertEquals('irrelevant', $person->getCity());
    }

    /** @test */
    public function Address_value_can_be_added(): void
    {
        $person = new Person();
        $person->setAddress('irrelevant');

        self::assertEquals('irrelevant', $person->getAddress());
    }

    /** @test */
    public function Etablissement_value_can_be_added(): void
    {
        $person = new Person();
        $person->setEtablissement('irrelevant');

        self::assertEquals('irrelevant', $person->getEtablissement());
    }

    /** @test */
    public function University_value_can_be_added(): void
    {
        $person = new Person();
        $person->setUniversity('irrelevant');

        self::assertEquals('irrelevant', $person->getUniversity());
    }

    /** @test */
    public function Gsm_value_can_be_added(): void
    {
        $person = new Person();
        $person->setGsm('irrelevant');

        self::assertEquals('irrelevant', $person->getGsm());
    }

    /** @test */
    public function Cnss_value_can_be_added(): void
    {
        $person = new Person();
        $person->setCnss('irrelevant');

        self::assertEquals('irrelevant', $person->getCnss());
    }

    /** @test */
    public function CnssType_value_can_be_added(): void
    {
        $person = new Person();
        $person->setCnsstype('irrelevant');

        self::assertEquals('irrelevant', $person->getCnsstype());
    }

    /** @test */
    public function IsHandicap_value_can_be_added(): void
    {
        $person = new Person();
        $person->setIsHandicap('irrelevant');

        self::assertEquals('irrelevant', $person->getIsHandicap());
    }

    /** @test */
    public function Handicap_value_can_be_added(): void
    {
        $person = new Person();
        $person->setHandicap('irrelevant');

        self::assertEquals('irrelevant', $person->getHandicap());
    }

    /** @test */
    public function Needs_value_can_be_added(): void
    {
        $person = new Person();
        $person->setNeeds('irrelevant');

        self::assertEquals('irrelevant', $person->getNeeds());
    }

    /** @test */
    public function Created_value_can_be_added(): void
    {
        $person = new Person();
        $person->setCreated($date = new \DateTime('01-01-1970'));

        self::assertEquals($date, $person->getCreated());
    }
}
