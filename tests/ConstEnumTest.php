<?php

namespace BronOS\PhpEnum\Tests;


use BronOS\PhpEnum\ConstEnum;
use BronOS\PhpEnum\EnumException;
use PHPUnit\Framework\TestCase;

/**
 * @covers \BronOS\PhpEnum\ConstEnum
 * @covers \BronOS\PhpEnum\ImmutableConstEnum
 */
class ConstEnumTest extends TestCase
{
    /**
     * @covers \BronOS\PhpEnum\ConstEnum::__construct
     * @covers \BronOS\PhpEnum\ConstEnum::getValue
     * @covers \BronOS\PhpEnum\ConstEnum::set
     * @covers \BronOS\PhpEnum\ConstEnum::setValue
     * @covers \BronOS\PhpEnum\ConstEnum::isValid
     * @covers \BronOS\PhpEnum\ConstEnum::getOptions
     */
    public function testSetValue()
    {
        $enum = new class(2) extends ConstEnum {
            public const ONE = 1;
            private const TWO = 2;
        };
        $this->assertEquals(2, $enum->getValue());

        $enum->setValue(1);
        $this->assertEquals(1, $enum->getValue());

        $this->expectException(EnumException::class);
        $enum->setValue(5);

    }
}
