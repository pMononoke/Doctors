<?php

declare(strict_types=1);

namespace App\Infrastructure\Persistence\DoctrineType;

use App\Entity\UserId;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\ConversionException;
use InvalidArgumentException;
use Ramsey\Uuid\Doctrine\UuidType;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

class UserIdType extends UuidType
{
    /**
     * @var string
     */
    const NAME = 'userId';

    /**
     * {@inheritdoc}
     *
     * @param string|UuidInterface|null $value
     */
    public function convertToPHPValue($value, AbstractPlatform $platform)
    {
        if (empty($value)) {
            return null;
        }

        if ($value instanceof UserId) {
            return $value;
        }

        try {
            $userId = UserId::fromString($value);
        } catch (InvalidArgumentException $e) {
            throw ConversionException::conversionFailed($value, static::NAME);
        }

        return $userId;
    }

    /**
     * {@inheritdoc}
     *
     * @param UserId|null $value
     */
    public function convertToDatabaseValue($value, AbstractPlatform $platform)
    {
        if (empty($value)) {
            return null;
        }

//        if (
//            $value instanceof UserId
//            || (
//                (is_string($value) || method_exists($value, '__toString'))
//                && Uuid::isValid((string) $value)
//            )
//        ) {
//            return (string) $value->toString();
//        }

        if ($value instanceof UserId) {
            return  $value->toString();
        }

        throw ConversionException::conversionFailed($value, static::NAME);
    }
}
