<?php

declare(strict_types=1);

namespace Hydrogen\Vocab\Native\Boolean\NativeBoolean\Contract\Container;

use Hydrogen\Contract\Sanitiser;
use Hydrogen\Value\Contract\Container\TypecastedValueContainer;
use Override;

/**
 * @phpstan-extends NativeBooleanValueContainer<bool>
 * @phpstan-implements TypecastedValueContainer<bool>
 */
class NativeBooleanCastedValue extends NativeBooleanValueContainer implements TypecastedValueContainer
{
    #[Override]
    public function getValue(): bool
    {
        $value = parent::getValue();
        assert(is_bool($value));
        return $value;
    }

    #[Override]
    public function preSanitise(Sanitiser $sanitiser): self
    {
        return new self($sanitiser($this->getValue()));
    }
}
