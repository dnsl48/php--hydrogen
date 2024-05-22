<?php declare(strict_types = 1);

namespace Hydrogen\Exception;

/**
 * When the data containers cannot function as expected.
 *
 * @phpstan-template T
 * @phpstan-extends DataIntegrityException<T>
 *
 * @api
 */
class DataContainerException extends DataIntegrityException
{
}
