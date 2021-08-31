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
 * Abstract immutable enum.
 *
 * @package      bronos\php-enum
 * @author       Oleg Bronzov <oleg.bronzov@gmail.com>
 * @copyright    2020
 * @license      https://opensource.org/licenses/MIT
 * @link         https://github.com/BronOS/php-enum
 */
abstract class AbstractImmutableEnum
{
    /**
     * @var int Enum's value.
     */
    private $value;

    /**
     * Abstract constructor.
     *
     * @param int $value
     *
     * @throws EnumException
     */
    public function __construct(int $value)
    {
        $this->set($value);
    }

    /**
     * Returns enum's value.
     *
     * @return int
     */
    public function getValue(): int
    {
        return $this->value;
    }

    /**
     * Sets enum's value.
     * If value is not valid it throws EnumException.
     *
     * @param int $value
     *
     * @throws EnumException
     */
    protected function set(int $value): void
    {
        if (!$this::isValid($value)) {
            throw new EnumException(sprintf('Invalid enum value: %s', $value));
        }

        $this->value = $value;
    }

    /**
     * Returns available options for the enum.
     *
     * @return int[]
     */
    abstract public static function getOptions(): array;

    /**
     * Validates value.
     *
     * @param int $value
     *
     * @return bool
     */
    public static function isValid(int $value): bool
    {
        if (!in_array($value, static::getOptions())) {
            return false;
        }

        return true;
    }

    /**
     * Compare internal value with passed.
     *
     * @param int $value
     *
     * @return bool
     */
    public function isEqual(int $value): bool
    {
        return $this->value == $value;
    }
}