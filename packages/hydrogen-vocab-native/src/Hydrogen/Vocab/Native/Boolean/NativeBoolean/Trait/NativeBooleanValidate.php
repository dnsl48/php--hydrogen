<?php declare(strict_types = 1);

namespace Hydrogen\Vocab\Native\Boolean\NativeBoolean\Trait;
use Hydrogen\Exception\DataValidationException;
use Hydrogen\Value\Contract\Container\SanitisedValueContainer;
use Hydrogen\Vocab\Native\Boolean\NativeBoolean\Contract\Container\NativeBooleanValidatedValue;
use Hydrogen\Vocab\Native\Boolean\NativeBoolean\Contract\Mission\NativeBooleanValidator;
use Override;

// class NativeBooleanValidate extends
trait NativeBooleanValidate
{
    /**
     * @phpstan-param SanitisedValueContainer<bool> $valueContainer
     *
     * @phpstan-assert NativeBooleanSanitisedValue $valueContainer
     *
     * @throws DataValidationException
     */
    #[Override]
    protected function validate(SanitisedValueContainer $valueContainer): NativeBooleanValidatedValue
    {
        static $nativeBooleanValidator = new NativeBooleanValidator();
        assert($nativeBooleanValidator instanceof NativeBooleanValidator);
        return $nativeBooleanValidator($valueContainer);
    }
}