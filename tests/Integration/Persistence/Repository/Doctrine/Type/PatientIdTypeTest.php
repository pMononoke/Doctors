<?php

declare(strict_types=1);

namespace App\Tests\Integration\Persistence\Repository\Doctrine\Type;

use App\Entity\PatientId;
use App\Infrastructure\Persistence\DoctrineType\PatientIdType;
use Doctrine\DBAL\DBALException;
use Doctrine\DBAL\Platforms\MySqlPlatform;
use Doctrine\DBAL\Types\ConversionException;
use Doctrine\DBAL\Types\Type;
use PHPUnit\Framework\TestCase;

class PatientIdTypeTest extends TestCase
{
    private const UUID = 'dc97e157-a0fa-478a-8ade-5692bbaa08e0';

    /** @var Type */
    private $type;

    /** @var AbstractPlatform */
    private $platform;

    public function setUp(): void
    {
        $this->platform = new MySqlPlatform();

        try {
            $this->type = Type::getType('patientId_test');
        } catch (DBALException $e) {
        }
    }

    public static function setUpBeforeClass(): void
    {
        Type::addType('patientId_test', PatientIdType::class);
    }

    /** @test */
    public function it_can_get_name(): void
    {
        $this->assertEquals('patientId', $this->type->getName());
    }

    /** @test */
    public function it_can_convert_to_a_php_value(): void
    {
        $value = self::UUID;
        $this->assertEquals(
            PatientId::fromString(self::UUID),
            $this->type->convertToPHPValue($value, $this->platform)
        );
    }

    /** @test */
    public function it_can_convert_a_null_value_to_a_php_value(): void
    {
        $this->assertNull($this->type->convertToPHPValue(null, $this->platform));
    }

    /** @test */
    public function it_can_convert_to_a_database_value(): void
    {
        $status = self::UUID;
        $guFeedId = PatientId::fromString(self::UUID);
        $this->assertEquals($guFeedId, $this->type->convertToDatabaseValue($guFeedId, $this->platform));
    }

    /** @test */
    public function it_can_not_convert_bad_value_to_php_value(): void
    {
        $this->expectException(ConversionException::class);
        $this->type->convertToPHPValue('bad_value', $this->platform);
    }

    /** @test */
    public function it_requires_sql_comment_hint(): void
    {
        $this->assertTrue($this->type->requiresSQLCommentHint($this->platform));
    }

    protected function tearDown(): void
    {
        $this->platform = null;
        $this->type = null;
    }
}
