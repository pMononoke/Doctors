<?php

declare(strict_types=1);

namespace MedicalMundi\Icd\Tests\Contract;

use MedicalMundi\Icd\Contract\IcdCodeDescription;

class DummyIcdCodeDescription extends IcdCodeDescription
{
    protected function validate(string $baseIcdCode): void
    {
        // TODO: Implement validate() method.
    }

    public static function fromString(string $icdCodeDescription): self //TODO  return new self($icdCodeDescription)
    {
        return new self($icdCodeDescription);
    }
}
