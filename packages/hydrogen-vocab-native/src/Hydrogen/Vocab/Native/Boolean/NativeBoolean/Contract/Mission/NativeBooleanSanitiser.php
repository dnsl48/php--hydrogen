<?php

declare(strict_types=1);

namespace Hydrogen\Vocab\Native\Boolean\NativeBoolean\Contract\Mission;

use Hydrogen\Exception\DataSanitisationException;
use Hydrogen\Value\Contract\Container\TypecastedValueContainer;
use Hydrogen\Value\Contract\Mission\ValueContainerSanitiser;
use Hydrogen\Vocab\Native\Boolean\NativeBoolean\Contract\Container\NativeBooleanCastedValue;
use Hydrogen\Vocab\Native\Boolean\NativeBoolean\Contract\Container\NativeBooleanSanitisedValue;
use Override;

/**
 * @phpstan-implements ValueContainerSanitiser<bool, bool>
 */
class NativeBooleanSanitiser implements ValueContainerSanitiser
{
    /**
     * @phpstan-param TypecastedValueContainer<bool> $valueContainer
     *
     * @phpstan-assert NativeBooleanCastedValue $valueContainer
     *
     * @phpstan-throws DataSanitisationException<bool>
     *
     * @throws DataSanitisationException
     */
    #[Override]
    public function __invoke(TypecastedValueContainer $valueContainer): NativeBooleanSanitisedValue
    {
        if ($valueContainer instanceof NativeBooleanSanitisedValue) {
            return $valueContainer;
        } elseif (!$valueContainer instanceof NativeBooleanCastedValue) {
            throw new DataSanitisationException(
                $valueContainer,
                sprintf('NativeBoolean expected, %s given', get_debug_type($valueContainer))
            );
        } else {
            return new NativeBooleanSanitisedValue($valueContainer->getValue());
        }
    }
}
