<?php declare(strict_types = 1);

namespace Hydrogen\Exception;

/**
 * When data cannot be safely converted
 * to expected types, formats or structures.
 */
class DataSanitisationException extends DataIntegrityException
{
}
