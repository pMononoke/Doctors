<?php

declare(strict_types=1);

namespace App\Entity\Icd9;

use InvalidArgumentException;
use MedicalMundi\Icd\Contract\IcdCodeDescription;
use MedicalMundi\Icd\Contract\IcdCodeDescriptionInterface;

class Icd9CodeDescription extends IcdCodeDescription implements IcdCodeDescriptionInterface
{
    private const MIN_LENGTH = 10;
    private const MAX_LENGTH = 255;

    protected function validate(string $baseIcdCode): void
    {
        if (strlen($baseIcdCode) < self::MIN_LENGTH) {
            throw  new InvalidArgumentException('ICD-9 code description is too short.');
        }

        if (strlen($baseIcdCode) > self::MAX_LENGTH) {
            throw  new InvalidArgumentException('ICD-9 code description is too long.');
        }
    }

    public static function fromString(string $icdCodeDescription): self
    {
        return new self($icdCodeDescription);
    }
}
