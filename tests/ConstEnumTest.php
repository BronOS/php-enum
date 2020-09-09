<?php

namespace BronOS\PhpEnum\Tests;


use BronOS\PhpEnum\ConstEnum;
use BronOS\PhpEnum\EnumException;
use PHPUnit\Framework\TestCase;

/**
 * @covers \BronOS\PhpEnum\ConstEnum
 */
class ConstEnumTest extends TestCase
{
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
