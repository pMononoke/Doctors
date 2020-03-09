<?php

namespace MedicalMundi\Icd\Icd10;

use MedicalMundi\Icd\Contract\IcdCodeDescriptionInterface;
use MedicalMundi\Icd\Contract\IcdCodeInterface;
use MedicalMundi\Icd\Contract\IcdInterface;

class Icd10 implements IcdInterface
{
    /** @var IcdCodeInterface */
    private $code;

    /** @var IcdCodeDescriptionInterface */
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

    public function equals(Icd10 $icd10): bool
    {
        return $this->code->toString() === $icd10->code->toString()
            && $this->description->toString() === $icd10->description->toString();
    }
}
