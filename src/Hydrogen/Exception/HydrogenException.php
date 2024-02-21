<?php declare(strict_types = 1);

namespace Hydrogen\Exception;

use Exception;
use Stringable;
use Throwable;

/**
 * The base exception for the Hydrogen library.
 *
 * Any exceptions initiated by Hydrogen logic must be derived from this one.
 *
 * @api
 */
class HydrogenException extends Exception
{
    public function __construct(Stringable|string $message, Throwable $previous = null, int $code = 0)
    {
        parent::__construct((string) $message, $code, $previous);
    }
}
