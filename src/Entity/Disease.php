<?php

declare(strict_types=1);

namespace App\Entity;

use App\Entity\Icd9\Icd9;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\DiseaseRepository")
 */
class Disease
{
    /**
     * @var int
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var Icd9
     * @ORM\Embedded(class = "App\Entity\Icd9\Icd9", columnPrefix = false)
     */
    private $diseases;

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getDiseases(): Icd9
    {
        return $this->diseases;
    }

    /**
     * @return Disease
     */
    public function setDiseases(Icd9 $diseases): self
    {
        $this->diseases = $diseases;

        return $this;
    }
}
