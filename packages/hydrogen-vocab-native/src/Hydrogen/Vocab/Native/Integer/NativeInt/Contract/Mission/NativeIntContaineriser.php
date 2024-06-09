<?php

declare(strict_types=1);

namespace Hydrogen\Vocab\Native\Integer\NativeInt\Contract\Mission;

use Hydrogen\Value\Contract\Mission\ValueContaineriser;
use Hydrogen\Vocab\Native\Integer\NativeInt\Contract\Container\NativeIntValueContainer;
use Override;

/**
 * @phpstan-implements ValueContaineriser<mixed>
 */
class NativeIntContaineriser implements ValueContaineriser
{
    /**
     * @phpstan-template T
     * @phpstan-param T $value
     * @phpstan-return NativeIntValueContainer<T>
     */
    #[Override]
    public function __invoke(mixed $value): NativeIntValueContainer
    {
        /** @var NativeIntValueContainer<T> */
        return new NativeIntValueContainer($value);
    }
}
