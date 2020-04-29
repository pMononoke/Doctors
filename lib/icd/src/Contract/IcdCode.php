<?php

declare(strict_types=1);

namespace MedicalMundi\Icd\Contract;

abstract class IcdCode
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

    abstract public static function fromString(string $baseIcdCode) //TODO  return new self($baseIcdCode)
    ;

    public function toString(): string
    {
        return $this->value;
    }

    public function __toString(): string
    {
        return $this->value;
    }

    public function equals(self $baseIcdCode): bool
    {
        return $this->value === $baseIcdCode->value;
    }
}
