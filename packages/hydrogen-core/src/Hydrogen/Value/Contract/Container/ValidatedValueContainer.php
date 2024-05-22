<?php declare(strict_types = 1);

namespace Hydrogen\Value\Contract\Container;

/**
 * @phpstan-template T
 *
 * @phpstan-extends SanitisedValueContainer<T>
 *
 * @api
 */
interface ValidatedValueContainer extends SanitisedValueContainer
{
}