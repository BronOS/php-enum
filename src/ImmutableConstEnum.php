<?php

/**
 * Php Enum
 *
 * MIT License
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in all
 * copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
 * SOFTWARE.
 *
 * @package      bronos\php-enum
 * @author       Oleg Bronzov <oleg.bronzov@gmail.com>
 * @copyright    2020
 * @license      https://opensource.org/licenses/MIT
 * @link         https://github.com/BronOS/php-enum
 */

declare(strict_types=1);

namespace BronOS\PhpEnum;


use ReflectionException;

/**
 * Immutable constant enum.
 * Available options are based on class constants.
 * Allows to use constants as a static method (as a factory) to instantiate new enum.
 * Example:
 *
 *      class MyEnum extend ConstEnum {
 *          public const ONE = 1;
 *          public const TWO = 2;
 *      }
 *
 *      $one = MyEnum::ONE(); // $one->getValue() == 1
 *      $two = MyEnum::TWO();  // $two->getValue() == 2
 *
 * @package      bronos\php-enum
 * @author       Oleg Bronzov <oleg.bronzov@gmail.com>
 * @copyright    2020
 * @license      https://opensource.org/licenses/MIT
 * @link         https://github.com/BronOS/php-enum
 */
class ImmutableConstEnum extends AbstractImmutableEnum
{
    private static array $options = [];

    /**
     * Returns available options for the enum.
     *
     * @return int[]
     *
     * @throws EnumException
     */
    public static function getOptions(): array
    {
        $className = static::class;

        if (!isset(static::$options[$className])) {
            try {
                static::$options[$className] = (new \ReflectionClass($className))->getConstants();
            } catch (ReflectionException $e) {
                throw new EnumException($e->getMessage(), $e->getCode(), $e);
            }

            // try to find duplicate options
            if (count(array_unique(static::$options[$className])) < count(static::$options[$className])) {
                // duplicate options detected
                throw new EnumException(sprintf('Duplicate enum options detected. [%s]', static::class));
            }

            // check options on INT
            foreach (static::$options[$className] as $optionName => $optionValue) {
                if (!is_int($optionValue)) {
                    // incorrect option type detected
                    throw new EnumException(
                        sprintf(
                            'Invalid enum option type. %s::%s = %s',
                            static::class,
                            $optionName,
                            $optionValue
                        )
                    );
                }
            }
        }

        return static::$options[$className];
    }

    /**
     * is triggered when invoking inaccessible methods in a static context.
     *
     * @param $name      string
     * @param $arguments array
     *
     * @return static
     *
     * @throws EnumException
     *
     * @link https://php.net/manual/en/language.oop5.overloading.php#language.oop5.overloading.methods
     */
    public static function __callStatic(string $name, array $arguments): self
    {
        $options = static::getOptions();
        if (isset($options[$name])) {
            return new static($options[$name]);
        }

        throw new EnumException(sprintf("Unknown enum constant [%s::%s]", static::class, $name));
    }

    /**
     * Returns string representation of value's constant name.
     *
     * @return string
     *
     * @throws EnumException
     */
    public function getOptionName(): string
    {
        return array_search($this->getValue(), static::getOptions());
    }
}