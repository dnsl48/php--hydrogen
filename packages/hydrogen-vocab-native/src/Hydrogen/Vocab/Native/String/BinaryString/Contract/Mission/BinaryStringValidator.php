<?php

declare(strict_types=1);

namespace Hydrogen\Vocab\Native\String\BinaryString\Contract\Mission;

use Hydrogen\Exception\DataValidationException;
use Hydrogen\Value\Contract\Container\SanitisedValueContainer;
use Hydrogen\Value\Contract\Mission\ValueContainerValidator;
use Hydrogen\Vocab\Native\String\BinaryString\Contract\Container\BinaryStringSanitisedValue;
use Hydrogen\Vocab\Native\String\BinaryString\Contract\Container\BinaryStringValidatedValue;
use Override;

/**
 * @phpstan-implements ValueContainerValidator<string, string>
 */
class BinaryStringValidator implements ValueContainerValidator
{
    #[Override]
    public function __invoke(SanitisedValueContainer $valueContainer): BinaryStringValidatedValue
    {
        if ($valueContainer instanceof BinaryStringValidatedValue) {
            return $valueContainer;
        } elseif (!$valueContainer instanceof BinaryStringSanitisedValue) {
            throw new DataValidationException(
                $valueContainer,
                "Expected a sanitised BinaryString, given " . get_debug_type($valueContainer)
            );
        } else {
            return new BinaryStringValidatedValue($valueContainer->getValue());
        }
    }
}
