<?php

declare(strict_types=1);

namespace MedicalMundi\Icd\Tests\Contract;

use MedicalMundi\Icd\Contract\IcdCode;

class DummyIcdCode extends IcdCode
{
    protected function validate(string $baseIcdCode): void
    {
        // TODO: Implement validate() method.
    }

    public static function fromString(string $baseIcdCode): self //TODO return new self($baseIcdCode)
    {
        return new self($baseIcdCode);
    }
}
