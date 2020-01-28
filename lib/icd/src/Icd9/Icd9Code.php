<?php

declare(strict_types=1);

namespace MedicalMundi\Icd\Icd9;

use MedicalMundi\Icd\Contract\IcdCode;
use MedicalMundi\Icd\Contract\IcdCodeInterface;

class Icd9Code extends IcdCode implements IcdCodeInterface
{
    protected function validate(string $baseIcdCode): void
    {
        // TODO: Implement validate() method.
    }

    public static function fromString(string $baseIcdCode): self
    {
        return new self($baseIcdCode);
    }
}
