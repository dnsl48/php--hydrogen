<?php

declare(strict_types=1);

namespace Hydrogen\Vocab\Native\String\BinaryString\Contract\Container;

use Hydrogen\Contract\Sanitiser;
use Hydrogen\Value\Contract\Container\TypecastedValueContainer;
use Override;
use Stringable;

/**
 * @phpstan-extends BinaryStringValueContainer<string>
 * @phpstan-implements TypecastedValueContainer<string>
 */
class BinaryStringCastedValue extends BinaryStringValueContainer implements TypecastedValueContainer, Stringable
{
    #[Override]
    public function getValue(): string
    {
        $value = parent::getValue();
        assert(is_string($value));
        return $value;
    }

    #[Override]
    public function preSanitise(Sanitiser $sanitiser): self
    {
        return new self($sanitiser($this->getValue()));
    }

    #[Override]
    public function __toString(): string
    {
        return $this->getValue();
    }
}
