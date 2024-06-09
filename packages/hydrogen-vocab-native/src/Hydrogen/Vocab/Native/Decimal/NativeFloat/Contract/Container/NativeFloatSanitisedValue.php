<?php

declare(strict_types=1);

namespace Hydrogen\Vocab\Native\Decimal\NativeFloat\Contract\Container;

use Hydrogen\Value\Contract\Container\SanitisedValueContainer;

/**
 * @phpstan-implements SanitisedValueContainer<float>
 */
class NativeFloatSanitisedValue extends NativeFloatCastedValue implements SanitisedValueContainer
{
}
