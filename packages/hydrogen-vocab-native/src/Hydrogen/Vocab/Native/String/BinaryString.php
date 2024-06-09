<?php

declare(strict_types=1);

namespace Hydrogen\Vocab\Native\String;

use Hydrogen\Value\AbstractValue;
use Hydrogen\Value\Trait\GenericSerialisationFallbacks;
use Hydrogen\Vocab\Native\String\BinaryString\Trait\BinaryStringContracts;
use Override;
use Stringable;

/**
 * @phpstan-extends AbstractValue<mixed, mixed, string, string, string>
 */
class BinaryString extends AbstractValue implements Stringable
{
    use GenericSerialisationFallbacks;
    use BinaryStringContracts;

    #[Override]
    public function __toString(): string
    {
        return (string) $this->getValue();
    }
}
