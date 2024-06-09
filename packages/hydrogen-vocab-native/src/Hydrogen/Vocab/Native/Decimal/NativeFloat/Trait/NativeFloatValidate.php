<?php

declare(strict_types=1);

namespace Hydrogen\Vocab\Native\Decimal\NativeFloat\Trait;

use Hydrogen\Exception\DataValidationException;
use Hydrogen\Value\Contract\Container\SanitisedValueContainer;
use Hydrogen\Vocab\Native\Decimal\NativeFloat\Contract\Container\NativeFloatSanitisedValue;
use Hydrogen\Vocab\Native\Decimal\NativeFloat\Contract\Container\NativeFloatValidatedValue;
use Hydrogen\Vocab\Native\Decimal\NativeFloat\Contract\Mission\NativeFloatValidator;
use Override;

trait NativeFloatValidate
{
    /**
     * @phpstan-param SanitisedValueContainer<float> $valueContainer
     *
     * @phpstan-assert NativeFloatSanitisedValue $valueContainer
     *
     * @throws DataValidationException
     */
    #[Override]
    protected function validate(SanitisedValueContainer $valueContainer): NativeFloatValidatedValue
    {

        static $nativeFloatValidator = new NativeFloatValidator();
        assert($nativeFloatValidator instanceof NativeFloatValidator);
        return $nativeFloatValidator($valueContainer);
    }
}
