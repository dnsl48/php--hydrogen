<?php

declare(strict_types=1);

namespace Hydrogen\Vocab\Native\Decimal\NativeFloat\Contract\Mission;

use Hydrogen\Exception\DataTypecastException;
use Hydrogen\Value\Contract\Container\ValueContainer;
use Hydrogen\Value\Contract\Mission\ValueContainerTypecaster;
use Hydrogen\Value\Contract\Typecast\ToNativeFloat;
use Hydrogen\Value\Contract\Typecast\ToNativeInt;
use Hydrogen\Vocab\Native\Decimal\NativeFloat\Contract\Container\NativeFloatCastedValue;
use Hydrogen\Vocab\Native\Decimal\NativeFloat\Contract\Container\NativeFloatValueContainer;
use Override;
use Stringable;

/**
 * @phpstan-implements ValueContainerTypecaster<mixed, float>
 */
class NativeFloatTypecaster implements ValueContainerTypecaster
{
    /**
     * @phpstan-template T
     *
     * @phpstan-param ValueContainer<T> $valueContainer
     *
     * @phpstan-assert NativeFloatValueContainer<T> $valueContainer
     * @throws DataTypecastException
     */
    #[Override]
    public function __invoke(ValueContainer $valueContainer): NativeFloatCastedValue
    {
        $value = $valueContainer->getValue();

        if (is_object($value)) {
            if ($value instanceof ToNativeFloat) {
                $value = $value->toNativeFloat();
            } elseif ($value instanceof ToNativeInt) {
                $value = $value->toNativeInt();
            } elseif ($value instanceof Stringable) {
                $value = (string) $value;
            }
        }

        if (null === $value) {
            $float = 0.0;
        } elseif (is_int($value)) {
            $float = (float) $value;
        } elseif (is_string($value) && (is_numeric($value = trim($value)) || strlen($value) === 0)) {
            $float = (float) $value;
        } elseif (is_float($value)) {
            $float = $value;
        } else {
            throw new DataTypecastException(
                $valueContainer->getValue(),
                "Could not cast to float the value of type " . get_debug_type($value) . " ($value)"
            );
        }

        return new NativeFloatCastedValue($float);
    }
}
