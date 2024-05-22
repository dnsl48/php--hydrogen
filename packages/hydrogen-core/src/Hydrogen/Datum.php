<?php declare(strict_types = 1);

namespace Hydrogen;

use JsonSerializable;
use Stringable;

/**
 * Datum represents a single valid unit of data represented as a PHP object.
 *
 * This interface is a contract enforcing validation on initialisation (in the constructor).
 *
 * @api
 */
interface Datum extends Stringable, JsonSerializable
{
}
