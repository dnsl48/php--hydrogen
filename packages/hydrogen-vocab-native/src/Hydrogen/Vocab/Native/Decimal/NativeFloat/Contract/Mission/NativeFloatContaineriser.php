<?php

declare(strict_types=1);

namespace Hydrogen\Vocab\Native\Decimal\NativeFloat\Contract\Mission;

use Hydrogen\Value\Contract\Mission\ValueContaineriser;
use Hydrogen\Vocab\Native\Decimal\NativeFloat\Contract\Container\NativeFloatValueContainer;
use Override;

/**
 * @phpstan-implements ValueContaineriser<mixed>
 */
class NativeFloatContaineriser implements ValueContaineriser
{
    /**
     * @phpstan-template T
     * @phpstan-param T $value
     * @phpstan-return NativeFloatValueContainer<T>
     */
    #[Override]
    public function __invoke(mixed $value): NativeFloatValueContainer
    {
        /** @var NativeFloatValueContainer<T> */
        return new NativeFloatValueContainer($value);
    }
}
