<?php

declare(strict_types=1);

namespace Hydrogen\Value\Contract\Typecast;

use Hydrogen\Contract\Typecast;

/**
 * @phpstan-template T
 * @phpstan-extends Typecast<T, ?T>
 *
 * @api
 */
interface Nullify extends Typecast
{
    /**
     * @phpstan-param T $value
     */
    public function isNull(mixed $value): bool;
}
