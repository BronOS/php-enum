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


/**
 * Constant enum.
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
class ConstEnum extends ImmutableConstEnum
{
    /**
     * Sets enum's value.
     * If value is not valid it throws EnumException.
     *
     * @param int $value
     *
     * @throws EnumException
     */
    public function setValue(int $value): void
    {
        $this->set($value);
    }
}