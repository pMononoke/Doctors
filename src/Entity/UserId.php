<?php

declare(strict_types=1);

namespace App\Entity;

final class UserId
{
    /** @var \Ramsey\Uuid\UuidInterface */
    private $uuid;

    public static function generate(): UserId
    {
        return new self(\Ramsey\Uuid\Uuid::uuid4());
    }

    public static function fromString(string $patientId): UserId
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

    public function equals(UserId $other): bool
    {
        return $this->uuid->equals($other->uuid);
    }
}
