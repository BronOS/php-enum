<?php

namespace BronOS\PhpEnum\Tests;


use BronOS\PhpEnum\AbstractImmutableEnum;
use BronOS\PhpEnum\EnumException;
use PHPUnit\Framework\TestCase;

/**
 * @covers \BronOS\PhpEnum\AbstractImmutableEnum
 */
class AbstractImmutableEnumTest extends TestCase
{
    public function testIsValid()
    {
        $enum = new class(2) extends AbstractImmutableEnum{
            public static function getOptions(): array
            {
                return [1,2,3];
            }
        };

        $this->assertTrue($enum::isValid(1));
        $this->assertFalse($enum::isValid(5));
    }

    public function testIsEqual()
    {
        $enum = new class(2) extends AbstractImmutableEnum{
            public static function getOptions(): array
            {
                return [1,2,3];
            }
        };

        $this->assertTrue($enum->isEqual(2));
        $this->assertFalse($enum->isEqual(5));
    }

    public function testGetOptions()
    {
        $enum = new class(2) extends AbstractImmutableEnum{
            public static function getOptions(): array
            {
                return [1,2,3];
            }
        };

        $this->assertEquals([1,2,3], $enum::getOptions());
    }

    public function testConstruct()
    {
        $enum = new class(2) extends AbstractImmutableEnum{
            public static function getOptions(): array
            {
                return [1,2,3];
            }
        };

        $this->assertEquals(2, $enum->getValue());
    }

    public function testConstructInvalidValue()
    {
        $this->expectException(EnumException::class);
        $enum = new class(5) extends AbstractImmutableEnum{
            public static function getOptions(): array
            {
                return [1,2,3];
            }
        };
    }
}
