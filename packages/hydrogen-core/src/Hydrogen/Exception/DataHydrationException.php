<?php declare(strict_types = 1);

namespace Hydrogen\Exception;

/**
 * When structs could not be hydrated for some reasons.
 *
 * @phpstan-template T
 * @phpstan-extends DataIntegrityException<T>
 *
 * @api
 */
class DataHydrationException extends DataIntegrityException
{
}
