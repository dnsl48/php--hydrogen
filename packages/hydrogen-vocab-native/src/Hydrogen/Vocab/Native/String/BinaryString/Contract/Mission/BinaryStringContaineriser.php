<?php

declare(strict_types=1);

namespace Hydrogen\Vocab\Native\String\BinaryString\Contract\Mission;

use Hydrogen\Value\Contract\Container\ValueContainer;
use Hydrogen\Value\Contract\Mission\ValueContaineriser;
use Hydrogen\Vocab\Native\String\BinaryString\Contract\Container\BinaryStringValueContainer;
use Override;

/**
 * @phpstan-implements ValueContaineriser<mixed>
 */
class BinaryStringContaineriser implements ValueContaineriser
{
    /**
     * @phpstan-return BinaryStringValueContainer<mixed>
     */
    #[Override]
    public function __invoke(mixed $value): BinaryStringValueContainer
    {
        if ($value instanceof BinaryStringValueContainer) {
            return $value;
        } elseif ($value instanceof ValueContainer) {
            return new BinaryStringValueContainer($value->getValue());
        } else {
            return new BinaryStringValueContainer($value);
        }
    }
}
