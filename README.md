# PHP Enum implementation
![Build Status](https://github.com/BronOS/php-enum/workflows/PHP%20Composer/badge.svg)
[![Build Status](https://travis-ci.com/BronOS/php-enum.svg?branch=master)](https://github.com/BronOS/php-enum)
[![Latest Stable Version](https://poser.pugx.org/bronos/php-enum/v)](//packagist.org/packages/bronos/php-enum) 
[![Total Downloads](https://poser.pugx.org/bronos/php-enum/downloads)](//packagist.org/packages/bronos/php-enum) 
[![Latest Unstable Version](https://poser.pugx.org/bronos/php-enum/v/unstable)](//packagist.org/packages/bronos/php-enum) 
[![License](https://poser.pugx.org/bronos/php-enum/license)](//packagist.org/packages/bronos/php-enum)

## Installation

```
composer require bronos/php-enum
```

## Declaration

```php
use BronOS\PhpEnum\ConstEnum;

class MyEnum extends ConstEnum
{
    private const ONE = 1;
    private const TWO = 2;
    private const THREE = 3;
}
```

## Usage

```php
$enumOne = MyEnum::ONE(); // $enumOne->getValue() == 1 
$enumTwo = MyEnum::TWO(); // $enumTwo->getValue() == 2
$enumTree = new MyEnum(3); // $enumThree->getValue() == 3

$enumOne->getOptionName() == 'ONE'; 
$enumOne->isEqual(1) == true; 
MyEnum::isValid(5) == false; 

new MyEnum(4); // EnumException
```
