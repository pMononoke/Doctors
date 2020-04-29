<?php

declare(strict_types=1);

namespace MedicalMundi\Icd\Tests\Contract;

use InvalidArgumentException;
use MedicalMundi\Icd\Contract\IcdCode;

class DummyIcdCodeWithValidation extends IcdCode
{
    private const MIN_LENGTH = 3;
    private const MAX_LENGTH = 7;

    protected function validate(string $baseIcdCode): void
    {
        if (strlen($baseIcdCode) < self::MIN_LENGTH) {
            throw  new InvalidArgumentException('Icd code is too short.');
        }

        if (strlen($baseIcdCode) > self::MAX_LENGTH) {
            throw  new InvalidArgumentException('Icd code is too long.');
        }
    }

    public static function fromString(string $baseIcdCode): self
    {
        return new self($baseIcdCode);
    }
}
