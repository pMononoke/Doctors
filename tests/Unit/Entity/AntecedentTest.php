<?php

declare(strict_types=1);

use App\Entity\Antecedent;
use PHPUnit\Framework\TestCase;

class AntecedentTest extends TestCase
{
    /** @test */
    public function can_be_created(): void
    {
        $antecedent = new Antecedent();

        self::assertInstanceOf(Antecedent::class, $antecedent);
        self::assertEquals(null, $antecedent->getId());
    }

    /** @test */
    public function can_store_antecedent_values(): void
    {
        $antecedent = new Antecedent();
        $antecedent->setAllergies('irrelevant');
        $antecedent->setAutres('irrelevant');
        $antecedent->setTraitement('irrelevant');
        $antecedent->setChirurgicaux('irrelevant');
        $antecedent->setType('irrelevant');
        //TODO
        //$antecedent->setPerson('irrelevant');

        self::assertEquals('irrelevant', $antecedent->getAllergies());
        self::assertEquals('irrelevant', $antecedent->getAutres());
        self::assertEquals('irrelevant', $antecedent->getTraitement());
        self::assertEquals('irrelevant', $antecedent->getChirurgicaux());
        self::assertEquals('irrelevant', $antecedent->getType());
    }
}
