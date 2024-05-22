<?php declare(strict_types = 1);

namespace Hydrogen\Vocab\Native\Decimal\NativeFloat\Contract\Mission;

use Hydrogen\Exception\DataValidationException;
use Hydrogen\Value\Contract\Container\SanitisedValueContainer;
use Hydrogen\Value\Contract\Mission\ValueContainerValidator;
use Hydrogen\Vocab\Native\Decimal\NativeFloat\Contract\Container\NativeFloatSanitisedValue;
use Hydrogen\Vocab\Native\Decimal\NativeFloat\Contract\Container\NativeFloatValidatedValue;
use Override;

/**
 * @phpstan-implements ValueContainerValidator<float, float>
 */
class NativeFloatValidator implements ValueContainerValidator
{
    /**
     * @phpstan-template T
     *
     * @phpstan-param SanitisedValueContainer<T> $valueContainer
     *
     * @phpstan-assert NativeFloatSanitisedValue $valueContainer
     *
     * @throws DataValidationException 
     */
    #[Override]
    public function __invoke(SanitisedValueContainer $valueContainer): NativeFloatValidatedValue
    {
        if ($valueContainer instanceof NativeFloatValidatedValue) {
            return $valueContainer;
        } elseif (!$valueContainer instanceof NativeFloatSanitisedValue) {
            throw new DataValidationException($valueContainer, "Expected a sanitised NativeFloat, given ".get_debug_type($valueContainer));
        } else {
            return new NativeFloatValidatedValue($valueContainer->getValue());
        }
    }
}
