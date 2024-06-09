<?php

declare(strict_types=1);

namespace Hydrogen\Vocab\Native\Boolean\NativeBoolean\Contract\Container;

use Hydrogen\Value\Contract\Container\SanitisedValueContainer;

/**
 * @phpstan-implements SanitisedValueContainer<bool>
 */
class NativeBooleanSanitisedValue extends NativeBooleanCastedValue implements SanitisedValueContainer
{
}
