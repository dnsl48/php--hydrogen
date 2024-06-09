<?php

declare(strict_types=1);

namespace Hydrogen\Value\Contract\Container;

use Hydrogen\Contract\Transformer;

/**
 * @phpstan-template T
 *
 * @api
 */
interface ValueContainer
{
    /**
     * @phpstan-return T
     */
    public function getValue(): mixed;

    /**
     * @phpstan-template R
     * @phpstan-param Transformer<T, R> $transformer
     * @phpstan-return ValueContainer<R>
     */
    public function transform(Transformer $transformer): ValueContainer;
}
