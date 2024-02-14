<?php declare(strict_types = 1);

namespace Hydrogen\Exception;

use Stringable;
use Throwable;

/**
 * Processed data is incorrect.
 * That may be due to data validation or sanitisation (see derived exceptions).
 *
 * Contains references to the original data causing the troubles.
 */
abstract class DataIntegrityException extends HydrogenException
{
    public function __construct(
        /** The bad value causing the issue */
        private mixed $badValue,
        Stringable|string $message,
        Throwable $previous = null
    )
    {
        parent::__construct($message, $previous);
    }

    public function getBadValue(): mixed
    {
        return $this->badValue;
    }
}
