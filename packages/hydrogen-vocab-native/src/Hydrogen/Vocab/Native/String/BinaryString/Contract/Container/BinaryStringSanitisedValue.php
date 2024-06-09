<?php

declare(strict_types=1);

namespace Hydrogen\Vocab\Native\String\BinaryString\Contract\Container;

use Hydrogen\Value\Contract\Container\SanitisedValueContainer;

/**
 * @phpstan-implements SanitisedValueContainer<string>
 */
class BinaryStringSanitisedValue extends BinaryStringCastedValue implements SanitisedValueContainer
{
}
