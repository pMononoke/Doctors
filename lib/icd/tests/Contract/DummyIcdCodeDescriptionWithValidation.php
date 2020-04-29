<?php

declare(strict_types=1);

namespace MedicalMundi\Icd\Tests\Contract;

use InvalidArgumentException;
use MedicalMundi\Icd\Contract\IcdCodeDescription;

class DummyIcdCodeDescriptionWithValidation extends IcdCodeDescription
{
    private const MIN_LENGTH = 3;
    private const MAX_LENGTH = 7;

    protected function validate(string $baseIcdCode): void
    {
        if (strlen($baseIcdCode) < self::MIN_LENGTH) {
            throw  new InvalidArgumentException('Icd code description is too short.');
        }

        if (strlen($baseIcdCode) > self::MAX_LENGTH) {
            throw  new InvalidArgumentException('Icd code description is too long.');
        }
    }

    public static function fromString(string $icdCodeDescription): self
    {
        return new self($icdCodeDescription);
    }
}
