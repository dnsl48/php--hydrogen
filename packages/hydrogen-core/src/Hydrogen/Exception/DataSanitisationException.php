<?php declare(strict_types = 1);

namespace Hydrogen\Exception;

/**
 * When data cannot be safely sanitised.
 *
 * @phpstan-template T
 * @phpstan-extends DataIntegrityException<T>
 *
 * @api
 */
class DataSanitisationException extends DataIntegrityException
{
}
