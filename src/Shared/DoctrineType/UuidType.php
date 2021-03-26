<?php declare(strict_types=1);

namespace App\Shared\DoctrineType;

use App\Shared\Infrastructure\Uuid\Uuid;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\ConversionException;
use Doctrine\DBAL\Types\Type;
use InvalidArgumentException;

class UuidType extends Type
{
    const TYPE_NAME = 'uuid';

    public function getSQLDeclaration(array $fieldDeclaration, AbstractPlatform $platform)
    {
        return 'varchar(36)';
    }

    public function convertToPHPValue($value, AbstractPlatform $platform)
    {
        if ($value === null || $value === '') {
            return null;
        }

        if ($value instanceof Uuid) {
            return $value;
        }
        try {
            $uuid = Uuid::fromString($value);
        } catch (InvalidArgumentException $e) {
            throw ConversionException::conversionFailed($value, self::TYPE_NAME);
        }

        return $uuid;
    }

    public function convertToDatabaseValue($value, AbstractPlatform $platform)
    {
        if ($value === null || $value === '') {
            return null;
        }

        if (is_string($value)) {
            return $value;
        }

        if ($value instanceof Uuid) {
            return $value->toString();
        }
        throw ConversionException::conversionFailed($value, self::TYPE_NAME);
    }

    public function getName()
    {
        return self::TYPE_NAME;
    }
}