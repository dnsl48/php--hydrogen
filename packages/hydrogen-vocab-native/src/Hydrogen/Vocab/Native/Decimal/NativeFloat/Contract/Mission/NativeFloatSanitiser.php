<?php

declare(strict_types=1);

namespace Hydrogen\Vocab\Native\Decimal\NativeFloat\Contract\Mission;

use Hydrogen\Exception\DataSanitisationException;
use Hydrogen\Value\Contract\Container\TypecastedValueContainer;
use Hydrogen\Value\Contract\Mission\ValueContainerSanitiser;
use Hydrogen\Vocab\Native\Decimal\NativeFloat\Contract\Container\NativeFloatCastedValue;
use Hydrogen\Vocab\Native\Decimal\NativeFloat\Contract\Container\NativeFloatSanitisedValue;
use Override;

/**
 * @phpstan-implements ValueContainerSanitiser<float, float>
 */
class NativeFloatSanitiser implements ValueContainerSanitiser
{
    /**
     * @phpstan-param TypecastedValueContainer<float> $valueContainer
     *
     * @phpstan-assert NativeFloatCastedValue $valueContainer
     *
     * @phpstan-throws DataSanitisationException<float>
     *
     * @throws DataSanitisationException
     */
    #[Override]
    public function __invoke(TypecastedValueContainer $valueContainer): NativeFloatSanitisedValue
    {
        if ($valueContainer instanceof NativeFloatSanitisedValue) {
            return $valueContainer;
        } elseif (!$valueContainer instanceof NativeFloatCastedValue) {
            throw new DataSanitisationException(
                $valueContainer,
                sprintf('NativeFloat expected, %s given', get_debug_type($valueContainer))
            );
        } else {
            return new NativeFloatSanitisedValue($valueContainer->getValue());
        }
    }
}
