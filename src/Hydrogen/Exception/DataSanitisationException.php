<?php declare(strict_types = 1);

namespace Hydrogen\Exception;

/**
 * When data cannot be safely converted to expected types, formats or structures.
 *
 * @template T
 * @extends DataIntegrityException<T>
 *
 * @api
 */
class DataSanitisationException extends DataIntegrityException
{
}
