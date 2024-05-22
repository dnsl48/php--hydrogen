<?php declare(strict_types = 1);

namespace Hydrogen\Vocab\Native\Decimal\NativeFloat\Contract\Container;

use Hydrogen\Contract\Sanitiser;
use Hydrogen\Value\Contract\Container\TypecastedValueContainer;
use Override;

/**
 * @phpstan-extends NativeFloatValueContainer<float>
 * @phpstan-implements TypecastedValueContainer<float>
 */
class NativeFloatCastedValue extends NativeFloatValueContainer implements TypecastedValueContainer
{
    #[Override]
    public function getValue(): float
    {
        $value = parent::getValue();
        assert(is_float($value));
        return $value;
    }

    #[Override]
    public function preSanitise(Sanitiser $sanitiser): self
    {
        return new self($sanitiser($this->getValue()));
    }
}