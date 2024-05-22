<?php declare(strict_types = 1);

namespace Hydrogen\Vocab\Native\String\BinaryString\Trait;

use Hydrogen\Exception\DataValidationException;
use Hydrogen\Value\Contract\Container\SanitisedValueContainer;
use Hydrogen\Vocab\Native\String\BinaryString\Contract\Container\BinaryStringValidatedValue;
use Hydrogen\Vocab\Native\String\BinaryString\Contract\Mission\BinaryStringValidator;
use Override;

trait BinaryStringValidate
{
    /**
     * @phpstan-throws DataValidationException<mixed>
     *
     * @throws DataValidationException
     */
    #[Override]
    protected function validate(SanitisedValueContainer $valueContainer): BinaryStringValidatedValue
    {
        /** @phpstan-var BinaryStringValidator */
        static $binaryStringValidator = new BinaryStringValidator();
        return $binaryStringValidator($valueContainer);
    }
}