<?php declare(strict_types = 1);

namespace Hydrogen\Exception;

/**
 * When data cannot be converted to expected types.
 *
 * @phpstan-template T
 * @phpstan-extends DataIntegrityException<T>
 *
 * @api
 */
class DataTypecastException extends DataIntegrityException
{
}
