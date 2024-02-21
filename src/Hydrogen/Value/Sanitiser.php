<?php declare(strict_types = 1);

namespace Hydrogen\Value;

use Hydrogen\Exception\DataSanitisationException;

/**
 * @template TValue
 * @template TResult
 * 
 * @api
 */
interface Sanitiser
{
    /**
     * Construct the sanitiser with the original value
     *
     * @param TValue $value The original value to sanitise
     */
    public function __construct($value);

    /**
     * @return TResult
     *
     * @throws DataSanitisationException
     * @phpstan-throws DataSanitisationException<TValue>
     */
    public function sanitise(): mixed;
}