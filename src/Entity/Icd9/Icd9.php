<?php

namespace App\Entity\Icd9;

use Doctrine\ORM\Mapping as ORM;
use MedicalMundi\Icd\Contract\IcdCodeDescriptionInterface;
use MedicalMundi\Icd\Contract\IcdCodeInterface;
use MedicalMundi\Icd\Contract\IcdInterface;

/**
 * @ORM\Embeddable
 */
class Icd9 implements IcdInterface
{
    /**
     * @var IcdCodeInterface
     * @ORM\Column(type = "string")
     */
    private $code;

    /**
     * @var IcdCodeDescriptionInterface
     * @ORM\Column(type = "string")
     */
    private $description;

    public function __construct(IcdCodeInterface $code, IcdCodeDescriptionInterface $description)
    {
        $this->code = $code;
        $this->description = $description;
    }

    public function code(): IcdCodeInterface
    {
        return $this->code;
    }

    public function description(): IcdCodeDescriptionInterface
    {
        return $this->description;
    }

    public function equals(Icd9 $icd9): bool
    {
        return $this->code->toString() === $icd9->code->toString()
            && $this->description->toString() === $icd9->description->toString();
    }
}
