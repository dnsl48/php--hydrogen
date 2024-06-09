<?php

declare(strict_types=1);

namespace Hydrogen\Exception;

/**
 * When data structured incorrectly (or meaninglessly).
 * E.g. unserializable entities declared as properties in DTOs.
 * Usually, should be addressable via fixing the application logic
 * or the data declarations.
 *
 * @api
 */
class LogicException extends HydrogenException
{
}
