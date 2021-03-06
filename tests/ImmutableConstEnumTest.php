<?php

namespace BronOS\PhpEnum\Tests;


use BronOS\PhpEnum\EnumException;
use BronOS\PhpEnum\ImmutableConstEnum;
use PHPUnit\Framework\TestCase;

/**
 * @covers \BronOS\PhpEnum\ImmutableConstEnum
 */
class ImmutableConstEnumTest extends TestCase
{
    /**
     * @covers \BronOS\PhpEnum\ImmutableConstEnum::__construct
     * @covers \BronOS\PhpEnum\ImmutableConstEnum::isValid
     * @covers \BronOS\PhpEnum\ImmutableConstEnum::getOptionName
     * @covers \BronOS\PhpEnum\ImmutableConstEnum::set
     * @covers \BronOS\PhpEnum\ImmutableConstEnum::getValue
     */
    public function testGetOptionName()
    {
        $enum = new class(2) extends ImmutableConstEnum {
            public const ONE = 1;
            private const TWO = 2;
        };

        $this->assertEquals('TWO', $enum->getOptionName());
        $this->assertEquals(2, $enum->getValue());
    }

    /**
     * @covers \BronOS\PhpEnum\ImmutableConstEnum::__construct
     * @covers \BronOS\PhpEnum\ImmutableConstEnum::getOptions
     * @covers \BronOS\PhpEnum\ImmutableConstEnum::isValid
     * @covers \BronOS\PhpEnum\ImmutableConstEnum::set
     */
    public function testGetOptions()
    {
        $enum = new class(2) extends ImmutableConstEnum {
            public const ONE = 1;
            private const TWO = 2;
        };

        $this->assertEquals(['ONE' => 1, 'TWO' => 2], $enum::getOptions());
    }

    /**
     * @covers \BronOS\PhpEnum\ImmutableConstEnum::__construct
     * @covers \BronOS\PhpEnum\ImmutableConstEnum::isValid
     * @covers \BronOS\PhpEnum\ImmutableConstEnum::set
     */
    public function testInvalidOptionType()
    {
        $this->expectException(EnumException::class);
        $enum = new class(2) extends ImmutableConstEnum {
            public const ONE = 'one';
            private const TWO = 2;
        };
    }

    /**
     * @covers \BronOS\PhpEnum\ImmutableConstEnum::__construct
     * @covers \BronOS\PhpEnum\ImmutableConstEnum::isValid
     * @covers \BronOS\PhpEnum\ImmutableConstEnum::set
     */
    public function testDuplicateOptions()
    {
        $this->expectException(EnumException::class);
        $enum = new class(2) extends ImmutableConstEnum {
            public const ONE = 1;
            private const TWO = 1;
        };
    }

    /**
     * @covers \BronOS\PhpEnum\ImmutableConstEnum::__construct
     * @covers \BronOS\PhpEnum\ImmutableConstEnum::getOptions
     * @covers \BronOS\PhpEnum\ImmutableConstEnum::getOptionName
     * @covers \BronOS\PhpEnum\ImmutableConstEnum::getValue
     * @covers \BronOS\PhpEnum\ImmutableConstEnum::isValid
     * @covers \BronOS\PhpEnum\ImmutableConstEnum::set
     */
    public function testCallStatic()
    {
        $enum = new class(2) extends ImmutableConstEnum {
            public const ONE = 1;
            private const TWO = 2;
        };

        $newEnumOne = $enum::ONE();
        $this->assertEquals(['ONE' => 1, 'TWO' => 2], $newEnumOne::getOptions());
        $this->assertEquals(1, $newEnumOne->getValue());
        $this->assertEquals('ONE', $newEnumOne->getOptionName());

        $newEnumTwo = $enum::TWO();
        $this->assertEquals(['ONE' => 1, 'TWO' => 2], $newEnumTwo::getOptions());
        $this->assertEquals(2, $newEnumTwo->getValue());
        $this->assertEquals('TWO', $newEnumTwo->getOptionName());

        $this->expectException(EnumException::class);
        $newEnumOne = $enum::THREE();
    }
}
