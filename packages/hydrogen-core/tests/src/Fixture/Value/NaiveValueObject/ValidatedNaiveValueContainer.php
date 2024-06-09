<?php

declare(strict_types=1);

namespace Hydrogen\Tests\Fixture\Value\NaiveValueObject;

use Hydrogen\Value\Contract\Container\ValidatedValueContainer;

/**
 * @phpstan-template T
 * @phpstan-extends SanitisedNaiveValueContainer<T>
 * @phpstan-implements ValidatedValueContainer<T>
 */
readonly class ValidatedNaiveValueContainer extends SanitisedNaiveValueContainer implements ValidatedValueContainer
{
}
