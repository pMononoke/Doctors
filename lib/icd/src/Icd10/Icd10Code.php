<?php

declare(strict_types=1);

namespace MedicalMundi\Icd\Icd10;

use MedicalMundi\Icd\Contract\IcdCode;
use MedicalMundi\Icd\Contract\IcdCodeInterface;

final class Icd10Code extends IcdCode implements IcdCodeInterface
{
    protected function validate(string $baseIcdCode): void
    {
        // TODO: Implement validate() method.
    }

    public static function fromString(string $baseIcdCode): self //TODO  return new self($baseIcdCode)
    {
        return new self($baseIcdCode);
    }
}
