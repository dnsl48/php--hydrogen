<?php

declare(strict_types=1);

namespace Hydrogen\Vocab\Native\String\BinaryString\Contract\Mission;

use Hydrogen\Exception\DataSanitisationException;
use Hydrogen\Value\Contract\Container\TypecastedValueContainer;
use Hydrogen\Value\Contract\Mission\ValueContainerSanitiser;
use Hydrogen\Vocab\Native\String\BinaryString\Contract\Container\BinaryStringCastedValue;
use Hydrogen\Vocab\Native\String\BinaryString\Contract\Container\BinaryStringSanitisedValue;
use Override;

/**
 * @phpstan-implements ValueContainerSanitiser<string, string>
 */
class BinaryStringSanitiser implements ValueContainerSanitiser
{
    /**
     * @phpstan-param TypecastedValueContainer<string> $valueContainer
     *
     * @phpstan-assert BinaryStringCastedValue $valueContainer
     *
     * @phpstan-throws DataSanitisationException<string>
     *
     * @throws DataSanitisationException
     */
    #[Override]
    public function __invoke(TypecastedValueContainer $valueContainer): BinaryStringSanitisedValue
    {
        if ($valueContainer instanceof BinaryStringSanitisedValue) {
            return $valueContainer;
        } elseif (!$valueContainer instanceof BinaryStringCastedValue) {
            throw new DataSanitisationException(
                $valueContainer,
                sprintf('BinaryString expected, %s given', get_debug_type($valueContainer))
            );
        } else {
            return new BinaryStringSanitisedValue($valueContainer->getValue());
        }
    }
}
