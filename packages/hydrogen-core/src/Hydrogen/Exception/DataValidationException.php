<?php

declare(strict_types=1);

namespace Hydrogen\Exception;

/**
 * When data values do not follow specified rules or boundaries.
 *
 * @phpstan-template T
 * @phpstan-extends DataIntegrityException<T>
 *
 * @api
 */
class DataValidationException extends DataIntegrityException
{
}
