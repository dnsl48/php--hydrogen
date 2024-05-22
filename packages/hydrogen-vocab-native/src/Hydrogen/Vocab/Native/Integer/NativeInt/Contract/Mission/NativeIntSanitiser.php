<?php declare(strict_types = 1);

namespace Hydrogen\Vocab\Native\Integer\NativeInt\Contract\Mission;

use Hydrogen\Exception\DataSanitisationException;
use Hydrogen\Value\Contract\Container\TypecastedValueContainer;
use Hydrogen\Value\Contract\Mission\ValueContainerSanitiser;
use Hydrogen\Vocab\Native\Integer\NativeInt\Contract\Container\NativeIntCastedValue;
use Hydrogen\Vocab\Native\Integer\NativeInt\Contract\Container\NativeIntSanitisedValue;
use Override;

/**
 * @phpstan-implements ValueContainerSanitiser<int, int>
 */
class NativeIntSanitiser implements ValueContainerSanitiser
{
    /**
     * @phpstan-param TypecastedValueContainer<int> $valueContainer
     *
     * @phpstan-assert NativeIntCastedValue $valueContainer
     *
     * @phpstan-throws DataSanitisationException<int>
     *
     * @throws DataSanitisationException
     */
    #[Override]
    public function __invoke(TypecastedValueContainer $valueContainer): NativeIntSanitisedValue
    {
        if ($valueContainer instanceof NativeIntSanitisedValue) {
            return $valueContainer;
        } elseif (!$valueContainer instanceof NativeIntCastedValue) {
            throw new DataSanitisationException($valueContainer, sprintf('NativeInt expected, %s given', get_debug_type($valueContainer)));
        } else {
            return new NativeIntSanitisedValue($valueContainer->getValue());
        }
    }
}