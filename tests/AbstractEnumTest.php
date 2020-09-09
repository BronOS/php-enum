<?php

namespace BronOS\PhpEnum\Tests;


use BronOS\PhpEnum\AbstractEnum;
use BronOS\PhpEnum\EnumException;
use PHPUnit\Framework\TestCase;

/**
 * @covers \BronOS\PhpEnum\AbstractEnum
 * @covers \BronOS\PhpEnum\AbstractImmutableEnum
 */
class AbstractEnumTest extends TestCase
{
    /**
     * @covers \BronOS\PhpEnum\AbstractEnum::setValue
     * @covers \BronOS\PhpEnum\AbstractEnum::getValue
     * @covers \BronOS\PhpEnum\AbstractEnum::isValid
     * @covers \BronOS\PhpEnum\AbstractEnum::set
     * @covers \BronOS\PhpEnum\AbstractEnum::__construct
     */
    public function testSetValue()
    {
        $enum = new class(2) extends AbstractEnum {
            public static function getOptions(): array
            {
                return [1,2,3];
            }
        };
        $this->assertTrue($enum::isValid(2));
        $this->assertFalse($enum::isValid(5));
        $this->assertEquals(2, $enum->getValue());

        $enum->setValue(1);
        $this->assertEquals(1, $enum->getValue());

        $this->expectException(EnumException::class);
        $enum->setValue(5);
    }
}
