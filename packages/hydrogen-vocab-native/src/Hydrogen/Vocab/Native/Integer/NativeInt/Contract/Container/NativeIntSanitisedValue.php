<?php

declare(strict_types=1);

namespace Hydrogen\Vocab\Native\Integer\NativeInt\Contract\Container;

use Hydrogen\Value\Contract\Container\SanitisedValueContainer;

/**
 * @phpstan-implements SanitisedValueContainer<int>
 */
class NativeIntSanitisedValue extends NativeIntCastedValue implements SanitisedValueContainer
{
}
