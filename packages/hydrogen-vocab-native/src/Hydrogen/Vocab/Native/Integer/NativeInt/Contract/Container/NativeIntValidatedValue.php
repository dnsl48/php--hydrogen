<?php declare(strict_types = 1);

namespace Hydrogen\Vocab\Native\Integer\NativeInt\Contract\Container;

use Hydrogen\Value\Contract\Container\ValidatedValueContainer;

/**
 * @phpstan-implements ValidatedValueContainer<int>
 */
class NativeIntValidatedValue extends NativeIntSanitisedValue implements ValidatedValueContainer
{
}