<?php

declare(strict_types=1);

namespace Hydrogen\Vocab\Native\Integer\NativeInt\Contract\Mission;

use Hydrogen\Exception\DataValidationException;
use Hydrogen\Value\Contract\Container\SanitisedValueContainer;
use Hydrogen\Value\Contract\Mission\ValueContainerValidator;
use Hydrogen\Vocab\Native\Integer\NativeInt\Contract\Container\NativeIntSanitisedValue;
use Hydrogen\Vocab\Native\Integer\NativeInt\Contract\Container\NativeIntValidatedValue;
use Override;

/**
 * @phpstan-implements ValueContainerValidator<int, int>
 */
class NativeIntValidator implements ValueContainerValidator
{
    /**
     * @phpstan-template T
     *
     * @phpstan-param SanitisedValueContainer<T> $valueContainer
     *
     * @phpstan-assert NativeIntSanitisedValue $valueContainer
     *
     * @throws DataValidationException
     */
    #[Override]
    public function __invoke(SanitisedValueContainer $valueContainer): NativeIntValidatedValue
    {
        if ($valueContainer instanceof NativeIntValidatedValue) {
            return $valueContainer;
        } elseif (!$valueContainer instanceof NativeIntSanitisedValue) {
            throw new DataValidationException(
                $valueContainer,
                "Expected a sanitised NativeInt, given " . get_debug_type($valueContainer)
            );
        } else {
            return new NativeIntValidatedValue($valueContainer->getValue());
        }
    }
}
