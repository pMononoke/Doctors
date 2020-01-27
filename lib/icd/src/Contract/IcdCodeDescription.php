<?php

declare(strict_types=1);

namespace MedicalMundi\Icd\Contract;

abstract class IcdCodeDescription
{
    /** @var string */
    private $value;

    protected function __construct(string $value)
    {
        $this->validate($value);
        $this->value = $value;
    }

    abstract protected function validate(string $baseIcdCode): void;

    public function value(): string
    {
        return $this->value;
    }

    abstract public static function fromString(string $icdCodeDescription) //TODO  return new self($icdCodeDescription)
    ;

    public function toString(): string
    {
        return $this->value;
    }

    public function __toString(): string
    {
        return $this->value;
    }

    public function equals(self $icdCodeDescription): bool
    {
        return $this->value === $icdCodeDescription->value;
    }
}
