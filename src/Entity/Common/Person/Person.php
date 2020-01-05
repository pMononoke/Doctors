<?php

declare(strict_types=1);

namespace App\Entity\Common\Person;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Embeddable
 */
class Person
{
    /** @var FullName */
    private $name;

    /**
     * Person constructor.
     */
    public function __construct(FullName $name)
    {
        $this->name = $name;
    }

    public function changeName(FullName $name): void
    {
        $this->name = $name;
    }

    public function name(): FullName
    {
        return $this->name;
    }

    public function equals(Person $person): bool
    {
        return $this->name()->equals($person->name);
    }
}
