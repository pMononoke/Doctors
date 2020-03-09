<?php

declare(strict_types=1);

namespace MedicalMundi\Icd\Icd10;

use InvalidArgumentException;
use MedicalMundi\Icd\Contract\IcdCodeDescription;
use MedicalMundi\Icd\Contract\IcdCodeDescriptionInterface;

final class Icd10CodeDescription extends IcdCodeDescription implements IcdCodeDescriptionInterface
{
    private const MIN_LENGTH = 10;
    private const MAX_LENGTH = 255;

    protected function validate(string $baseIcdCode): void
    {
        if (strlen($baseIcdCode) < self::MIN_LENGTH) {
            throw  new InvalidArgumentException('ICD-10 code description is too short.');
        }

        if (strlen($baseIcdCode) > self::MAX_LENGTH) {
            throw  new InvalidArgumentException('ICD-10 code description is too long.');
        }
    }

    public static function fromString(string $icdCodeDescription): self
    {
        return new self($icdCodeDescription);
    }
}
