<?php declare(strict_types = 1);

namespace Tests\Fixture\Value\NaiveValueObject;

use Hydrogen\Value\Contract\Container\SanitisedValueContainer;

/**
 * @phpstan-template T
 * @phpstan-extends TypecastedNaiveValueContainer<T>
 * @phpstan-implements SanitisedValueContainer<T>
 */
class SanitisedNaiveValueContainer extends TypecastedNaiveValueContainer implements SanitisedValueContainer
{
}