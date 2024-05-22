<?php declare(strict_types=1);

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
     * @phpstan-param TypecastedValueContainer<string> $value
     *
     * @phpstan-assert BinaryStringCastedValue $value
     *
     * @phpstan-throws DataSanitisationException<string>
     *
     * @throws DataSanitisationException
     */
    #[Override]
    public function __invoke(TypecastedValueContainer $value): BinaryStringSanitisedValue
    {
        if ($value instanceof BinaryStringSanitisedValue) {
            return $value;
        } elseif (!$value instanceof BinaryStringCastedValue) {
            throw new DataSanitisationException($value, sprintf('BinaryString expected, %s given', get_debug_type($value)));
        } else {
            return new BinaryStringSanitisedValue($value->getValue());
        }
    }
}
