<?php declare(strict_types = 1);

namespace Hydrogen\Vocab\Native\Boolean\NativeBoolean\Contract\Container;
use Hydrogen\Value\Contract\Container\ValidatedValueContainer;

/**
 * @phpstan-implements ValidatedValueContainer<bool>
 */
class NativeBooleanValidatedValue extends NativeBooleanSanitisedValue implements ValidatedValueContainer
{
}