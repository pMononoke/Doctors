<?php

declare(strict_types=1);

namespace App\Tests\Unit\Entity\Person;

use App\Entity\Common\Person\LastName;
use PHPUnit\Framework\TestCase;

class LastNameTest extends TestCase
{
    private const LAST_NAME = 'Irrelevant';

    /** @test */
    public function can_be_created_from_string(): void
    {
        $firstName = LastName::fromString(self::LAST_NAME);

        self::assertInstanceOf(LastName::class, $firstName);
        self::assertEquals(self::LAST_NAME, $firstName->toString());
        self::assertEquals(self::LAST_NAME, $firstName->__toString());
    }

    /** @test */
    public function can_be_compared(): void
    {
        $first = LastName::fromString(self::LAST_NAME);
        $second = LastName::fromString('other irrelevant');
        $copyOfFirst = LastName::fromString(self::LAST_NAME);

        self::assertFalse($first->equals($second));
        self::assertTrue($first->equals($copyOfFirst));
        self::assertFalse($second->equals($copyOfFirst));
    }

    /**
     * @test
     * @expectedException \InvalidArgumentException
     */
    public function a_short_last_name_throw_exception(): void
    {
        LastName::fromString('a');
    }
}
