<?php

declare(strict_types=1);

namespace Hydrogen\Vocab\Native\Boolean\NativeBoolean\Contract\Mission;

use Hydrogen\Exception\DataTypecastException;
use Hydrogen\Value\Contract\Container\ValueContainer;
use Hydrogen\Value\Contract\Mission\ValueContainerTypecaster;
use Hydrogen\Value\Contract\Typecast\ToNativeBool;
use Hydrogen\Value\Contract\Typecast\ToNativeFloat;
use Hydrogen\Value\Contract\Typecast\ToNativeInt;
use Hydrogen\Vocab\Native\Boolean\NativeBoolean\Contract\Container\NativeBooleanCastedValue;
use Hydrogen\Vocab\Native\Boolean\NativeBoolean\Contract\Container\NativeBooleanValueContainer;
use Override;
use Stringable;

/**
 * @phpstan-implements ValueContainerTypecaster<mixed, bool>
 */
class NativeBooleanTypecaster implements ValueContainerTypecaster
{
    /**
     * @phpstan-template T
     *
     * @phpstan-param ValueContainer<T> $valueContainer
     *
     * @phpstan-assert NativeBooleanValueContainer<T> $valueContainer
     * @throws DataTypecastException
     */
    #[Override]
    public function __invoke(ValueContainer $valueContainer): NativeBooleanCastedValue
    {
        $value = $valueContainer->getValue();

        if (is_object($value)) {
            if ($value instanceof ToNativeBool) {
                $value = $value->toNativeBool();
            } elseif ($value instanceof ToNativeFloat) {
                $value = $value->toNativeFloat();
            } elseif ($value instanceof ToNativeInt) {
                $value = $value->toNativeInt();
            } elseif ($value instanceof Stringable) {
                $value = (string) $value;
            }
        }

        if (null === $value) {
            $bool = false;
        } elseif (is_int($value)) {
            $bool = (bool) $value;
        } elseif (is_string($value)) {
            $bool = (bool) $value;
        } elseif (is_float($value)) {
            $bool = (bool) $value;
        } else {
            throw new DataTypecastException(
                $valueContainer->getValue(),
                "Could not cast to float the value of type " . get_debug_type($value) . " ($value)"
            );
        }

        return new NativeBooleanCastedValue($bool);
    }
}
