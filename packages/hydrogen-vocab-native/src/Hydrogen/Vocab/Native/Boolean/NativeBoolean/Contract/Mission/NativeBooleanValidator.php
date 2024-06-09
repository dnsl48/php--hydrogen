<?php

declare(strict_types=1);

namespace Hydrogen\Vocab\Native\Boolean\NativeBoolean\Contract\Mission;

use Hydrogen\Exception\DataValidationException;
use Hydrogen\Value\Contract\Container\SanitisedValueContainer;
use Hydrogen\Value\Contract\Mission\ValueContainerValidator;
use Hydrogen\Vocab\Native\Boolean\NativeBoolean\Contract\Container\NativeBooleanSanitisedValue;
use Hydrogen\Vocab\Native\Boolean\NativeBoolean\Contract\Container\NativeBooleanValidatedValue;
use Override;

/**
 * @phpstan-implements ValueContainerValidator<bool, bool>
 */
class NativeBooleanValidator implements ValueContainerValidator
{
    /**
     * @phpstan-template T
     *
     * @phpstan-param SanitisedValueContainer<T> $valueContainer
     *
     * @phpstan-assert NativeBooleanSanitisedValue $valueContainer
     *
     * @throws DataValidationException
     */
    #[Override]
    public function __invoke(SanitisedValueContainer $valueContainer): NativeBooleanValidatedValue
    {
        if ($valueContainer instanceof NativeBooleanValidatedValue) {
            return $valueContainer;
        } elseif (!$valueContainer instanceof NativeBooleanSanitisedValue) {
            throw new DataValidationException(
                $valueContainer,
                "Expected a sanitised NativeBoolean, given " . get_debug_type($valueContainer)
            );
        } else {
            return new NativeBooleanValidatedValue($valueContainer->getValue());
        }
    }
}
