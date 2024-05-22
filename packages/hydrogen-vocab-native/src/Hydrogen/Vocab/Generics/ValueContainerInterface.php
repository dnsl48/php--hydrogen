<?php declare(strict_types = 1);

namespace Hydrogen\Vocab\Generics;
use Hydrogen\Value\Contract\Container\ValueContainer;

/**
 * @phpstan-template T
 *
 * @phpstan-extends ValueContainer<T>
 */
interface ValueContainerInterface extends ValueContainer
{
    public function __construct(
        /** @phpstan-var T */
        mixed $value
    );
}