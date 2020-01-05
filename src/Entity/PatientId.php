<?php

declare(strict_types=1);

namespace App\Entity;

final class PatientId
{
    /** @var \Ramsey\Uuid\UuidInterface */
    private $uuid;

    public static function generate(): PatientId
    {
        return new self(\Ramsey\Uuid\Uuid::uuid4());
    }

    public static function fromString(string $patientId): PatientId
    {
        return new self(\Ramsey\Uuid\Uuid::fromString($patientId));
    }

    private function __construct(\Ramsey\Uuid\UuidInterface $patientId)
    {
        $this->uuid = $patientId;
    }

    public function toString(): string
    {
        return $this->uuid->toString();
    }

    public function __toString(): string
    {
        return $this->uuid->toString();
    }

    public function equals(PatientId $other): bool
    {
        return $this->uuid->equals($other->uuid);
    }
}
