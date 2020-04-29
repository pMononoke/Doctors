<?php

declare(strict_types=1);

namespace MedicalMundi\Icd\Tests\Contract;

use MedicalMundi\Icd\Contract\IcdInterface;
use PHPUnit\Framework\TestCase;

class IcdDummyTest extends TestCase
{
    /** @test */
    public function can_create_IcdDummy(): void
    {
        $icd = new IcdDummy();

        self::assertInstanceOf(IcdInterface::class, $icd);
    }
}
