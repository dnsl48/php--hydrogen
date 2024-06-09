<?php

declare(strict_types=1);

namespace Hydrogen\Vocab\Native\String\BinaryString\Contract\Container;

use Hydrogen\Value\Contract\Container\ValidatedValueContainer;

/**
 * @phpstan-implements ValidatedValueContainer<string>
 */
class BinaryStringValidatedValue extends BinaryStringSanitisedValue implements ValidatedValueContainer
{
}
