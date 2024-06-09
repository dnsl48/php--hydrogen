<?php

declare(strict_types=1);

namespace Hydrogen\Vocab\Native\Decimal\NativeFloat\Contract\Container;

use Hydrogen\Value\Contract\Container\ValidatedValueContainer;

/**
 * @phpstan-implements ValidatedValueContainer<float>
 */
class NativeFloatValidatedValue extends NativeFloatSanitisedValue implements ValidatedValueContainer
{
}
