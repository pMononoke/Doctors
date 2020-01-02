<?php

declare(strict_types=1);

namespace App\Infrastructure\Persistence\DoctrineType;

use App\Entity\PatientId;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\ConversionException;
use InvalidArgumentException;
use Ramsey\Uuid\Doctrine\UuidType;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

class PatientIdType extends UuidType
{
    /**
     * @var string
     */
    const NAME = 'patientId';

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

        if ($value instanceof PatientId) {
            return $value;
        }

        try {
            $patientId = PatientId::fromString($value);
        } catch (InvalidArgumentException $e) {
            throw ConversionException::conversionFailed($value, static::NAME);
        }

        return $patientId;
    }

    /**
     * {@inheritdoc}
     *
     * @param PatientId|null $value
     */
    public function convertToDatabaseValue($value, AbstractPlatform $platform)
    {
        if (empty($value)) {
            return null;
        }

//        if (
//            $value instanceof PatientId
//            || (
//                (is_string($value) || method_exists($value, '__toString'))
//                && Uuid::isValid((string) $value)
//            )
//        ) {
//            return (string) $value->toString();
//        }

        if ($value instanceof PatientId) {
            return  $value->toString();
        }

        throw ConversionException::conversionFailed($value, static::NAME);
    }
}
