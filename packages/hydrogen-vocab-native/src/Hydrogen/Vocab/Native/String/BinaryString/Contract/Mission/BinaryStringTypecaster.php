<?php

declare(strict_types=1);

namespace Hydrogen\Vocab\Native\String\BinaryString\Contract\Mission;

use BackedEnum;
use Hydrogen\Exception\DataTypecastException;
use Hydrogen\Value\Contract\Container\ValueContainer;
use Hydrogen\Value\Contract\Mission\ValueContainerTypecaster;
use Hydrogen\Vocab\Native\String\BinaryString\Contract\Container\BinaryStringCastedValue;
use Hydrogen\Vocab\Native\String\BinaryString\Contract\Container\BinaryStringValueContainer;
use Override;
use Stringable;
use UnitEnum;

/**
 * @phpstan-implements ValueContainerTypecaster<mixed, string>
 */
class BinaryStringTypecaster implements ValueContainerTypecaster
{
    /**
     * @phpstan-template T
     *
     * @phpstan-param ValueContainer<T> $valueContainer
     *
     * @phpstan-assert BinaryStringValueContainer<T> $valueContainer
     * @throws DataTypecastException
     */
    #[Override]
    public function __invoke(ValueContainer $valueContainer): BinaryStringCastedValue
    {
        if ($valueContainer instanceof BinaryStringCastedValue) {
            return $valueContainer;
        } else {
            $value = $valueContainer->getValue();

            return new BinaryStringCastedValue(match (true) {
                null === $value => '',
                is_scalar($value), $value instanceof Stringable => (string) $value,
                $value instanceof BackedEnum => (string) $value->value,
                $value instanceof UnitEnum => $value->name,
                default => throw new DataTypecastException(
                    $value,
                    "Could not stringify the value of type " . get_debug_type($value)
                )
            });
        }
    }
}
