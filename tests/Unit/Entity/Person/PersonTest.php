<?php

declare(strict_types=1);

namespace App\Tests\Unit\Entity\Person;

use App\Entity\Common\Person\FirstName;
use App\Entity\Common\Person\FullName;
use App\Entity\Common\Person\LastName;
use App\Entity\Common\Person\Person;
use PHPUnit\Framework\TestCase;

class PersonTest extends TestCase
{
    private const FIRST_NAME = 'irrelevant';
    private const LAST_NAME = 'irrelevant';
    private const EMAIL = 'irrelevant@examle.com';
    private const MOBILE_NUMBER = '+39-392-1111111';

    /** @test */
    public function can_be_created(): void
    {
        $fullName = new FullName(
            $firstName = FirstName::fromString(self::FIRST_NAME),
            $lastName = LastName::fromString(self::LAST_NAME)
        );

        $person = new Person($fullName);

        self::assertEquals($fullName, $person->name());
    }

    /** @test */
    public function can_change_name(): void
    {
        $fullName = new FullName(
            $firstName = FirstName::fromString(self::FIRST_NAME),
            $lastName = LastName::fromString(self::LAST_NAME)
        );
        $newFullName = new FullName(
            $newFirstName = FirstName::fromString('new'),
            $newLastName = LastName::fromString('new')
        );
        $person = new Person($fullName);

        $person->changeName($newFullName);

        self::assertTrue($person->name()->equals($newFullName));
    }

    /** @test */
    public function can_be_compared(): void
    {
        $firstPerson = new Person(
            new FullName(
                $firstName = FirstName::fromString(self::FIRST_NAME),
                $lastName = LastName::fromString(self::LAST_NAME)
            )
        );
        $secondPerson = new Person(
            new FullName(
                FirstName::fromString('second'),
                LastName::fromString('second')
            )
        );
        $copyOfFirstPerson = new Person(
            new FullName(
                $firstName = FirstName::fromString(self::FIRST_NAME),
                $lastName = LastName::fromString(self::LAST_NAME)
            )
        );

        self::assertFalse($firstPerson->equals($secondPerson));
        self::assertTrue($firstPerson->equals($copyOfFirstPerson));
        self::assertFalse($secondPerson->equals($copyOfFirstPerson));
    }
}
