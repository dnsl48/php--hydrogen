<?php

declare(strict_types=1);

namespace Hydrogen\Value\Contract\Container;

/**
 * @phpstan-template T
 *
 * @phpstan-extends TypecastedValueContainer<T>
 *
 * @api
 */
interface SanitisedValueContainer extends TypecastedValueContainer
{
}
