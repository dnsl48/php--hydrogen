<?php

declare(strict_types=1);

namespace Hydrogen\Vocab\Native\Integer\NativeInt\Contract\Mission;

use Hydrogen\Exception\DataTypecastException;
use Hydrogen\Value\Contract\Container\ValueContainer;
use Hydrogen\Value\Contract\Mission\ValueContainerTypecaster;
use Hydrogen\Value\Contract\Typecast\ToNativeInt;
use Hydrogen\Vocab\Native\Integer\NativeInt\Contract\Container\NativeIntCastedValue;
use Hydrogen\Vocab\Native\Integer\NativeInt\Contract\Container\NativeIntValueContainer;
use Override;
use Stringable;

/**
 * @phpstan-implements ValueContainerTypecaster<mixed, int>
 */
class NativeIntTypecaster implements ValueContainerTypecaster
{
    /**
     * @phpstan-template T
     *
     * @phpstan-param ValueContainer<T> $valueContainer
     *
     * @phpstan-assert NativeIntValueContainer<T> $valueContainer
     * @throws DataTypecastException
     */
    #[Override]
    public function __invoke(ValueContainer $valueContainer): NativeIntCastedValue
    {
        $value = $valueContainer->getValue();

        if (is_object($value)) {
            if ($value instanceof ToNativeInt) {
                $value = $value->toNativeInt();
            } elseif ($value instanceof Stringable) {
                $value = (string) $value;
            }
        }

        if (null === $value) {
            $integer = 0;
        } elseif (is_int($value)) {
            $integer = $value;
        } elseif (is_string($value) && ctype_digit($value = trim($value))) {
            $integer = (int) $value;
        } elseif (is_float($value) && (int) $value == $value) {
            $integer = (int) $value;
        } else {
            throw new DataTypecastException(
                $valueContainer->getValue(),
                "Could not cast to int the value of type " . get_debug_type($value)
            );
        }

        return new NativeIntCastedValue($integer);
    }
}
