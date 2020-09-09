<?php

namespace BronOS\PhpEnum\Tests;


use BronOS\PhpEnum\AbstractEnum;
use BronOS\PhpEnum\EnumException;
use PHPUnit\Framework\TestCase;

/**
 * @covers \BronOS\PhpEnum\AbstractEnum
 */
class AbstractEnumTest extends TestCase
{
    public function testSetValue()
    {
        $enum = new class(2) extends AbstractEnum {
            public static function getOptions(): array
            {
                return [1,2,3];
            }
        };
        $this->assertEquals(2, $enum->getValue());

        $enum->setValue(1);
        $this->assertEquals(1, $enum->getValue());

        $this->expectException(EnumException::class);
        $enum->setValue(5);
    }
}
