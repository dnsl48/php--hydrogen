<?php

declare(strict_types=1);

namespace Hydrogen;

use Hydrogen\Exception\HydrogenException;
use Traversable;

/**
 * Represents a data Structure
 *
 * @api
 */
interface Struct extends Datum
{
    /**
     * @phpstan-param (object|Traversable<array-key, mixed>)[] $sources The list of sources to hydrate from
     * @param (object|iterable)[] $sources The list of sources to hydrate from
     *
     * @throws HydrogenException
     */
    public static function construct(object|iterable ...$sources): static;
}
