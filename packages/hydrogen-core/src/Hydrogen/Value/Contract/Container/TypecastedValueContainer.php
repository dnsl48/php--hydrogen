<?php declare(strict_types = 1);

namespace Hydrogen\Value\Contract\Container;

use Hydrogen\Contract\Sanitiser;

/**
 * @phpstan-template T
 *
 * @phpstan-extends ValueContainer<T>
 *
 * @api
 */
interface TypecastedValueContainer extends ValueContainer
{
    /**
     * @phpstan-param Sanitiser<T> $sanitiser
     * @phpstan-return TypecastedValueContainer<T>
     */
    public function preSanitise(Sanitiser $sanitiser): TypecastedValueContainer;
}
