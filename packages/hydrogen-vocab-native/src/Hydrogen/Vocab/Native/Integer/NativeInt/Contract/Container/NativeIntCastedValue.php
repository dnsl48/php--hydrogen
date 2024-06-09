<?php

declare(strict_types=1);

namespace Hydrogen\Vocab\Native\Integer\NativeInt\Contract\Container;

use Hydrogen\Contract\Sanitiser;
use Hydrogen\Value\Contract\Container\TypecastedValueContainer;
use Hydrogen\Value\Contract\Typecast\ToNativeInt;
use Override;

/**
 * @phpstan-extends NativeIntValueContainer<int>
 * @phpstan-implements TypecastedValueContainer<int>
 */
class NativeIntCastedValue extends NativeIntValueContainer implements TypecastedValueContainer, ToNativeInt
{
    #[Override]
    public function getValue(): int
    {
        $value = parent::getValue();
        assert(is_int($value));
        return $value;
    }

    #[Override]
    public function preSanitise(Sanitiser $sanitiser): self
    {
        return new self($sanitiser($this->getValue()));
    }

    #[Override]
    public function toNativeInt(): int
    {
        return $this->getValue();
    }
}
