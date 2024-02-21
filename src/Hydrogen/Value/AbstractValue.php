<?php declare(strict_types = 1);

namespace Hydrogen\Value;

use Hydrogen\Exception\DataSanitisationException;
use Hydrogen\Exception\DataValidationException;
use Hydrogen\Value;

/**
 * template TValue
 * template-covariant U Internal type expected by the validation method
 *
 * @api
 */
abstract class AbstractValue implements Value
{
    // /**
    //  * Sanitise the value before validation.
    //  * Should be used to cast between types where appropriate.
    //  *
    //  * phpstan-param S $value Raw value before the validation
    //  * phpstan-return U Sanitised/Casted value to be validated and wrapped up
    //  * 
    //  * @throws DataSanitisationException
    //  */
    // abstract protected function sanitise($value);

    // /**
    //  * phpstan-param U $value Validate
    //  */
    // abstract public static function validateSanitisedValue($value): bool;

    // /**
    //  * Validate the initialized instance of the type.
    //  * Should be called by the implementations.
    //  *
    //  * @throws DataValidationException
    //  */
    // abstract protected function validate(): void;
}