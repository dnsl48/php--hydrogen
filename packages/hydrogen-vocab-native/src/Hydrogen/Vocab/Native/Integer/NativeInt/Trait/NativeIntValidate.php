<?php

declare(strict_types=1);

namespace Hydrogen\Vocab\Native\Integer\NativeInt\Trait;

use Hydrogen\Exception\DataValidationException;
use Hydrogen\Value\Contract\Container\SanitisedValueContainer;
use Hydrogen\Vocab\Native\Integer\NativeInt\Contract\Container\NativeIntSanitisedValue;
use Hydrogen\Vocab\Native\Integer\NativeInt\Contract\Container\NativeIntValidatedValue;
use Hydrogen\Vocab\Native\Integer\NativeInt\Contract\Mission\NativeIntValidator;
use Override;

trait NativeIntValidate
{
    /**
     * @phpstan-param SanitisedValueContainer<int> $valueContainer
     *
     * @phpstan-assert NativeIntSanitisedValue $valueContainer
     *
     * @throws DataValidationException
     */
    #[Override]
    protected function validate(SanitisedValueContainer $valueContainer): NativeIntValidatedValue
    {
        static $nativeIntValidator = new NativeIntValidator();
        assert($nativeIntValidator instanceof NativeIntValidator);
        return $nativeIntValidator($valueContainer);
    }
}
