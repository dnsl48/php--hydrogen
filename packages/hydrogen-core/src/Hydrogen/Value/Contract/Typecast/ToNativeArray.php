<?php

declare(strict_types=1);

namespace Hydrogen\Value\Contract\Typecast;

/**
 * @phpstan-template Key
 * @phpstan-template Value
 */
interface ToNativeArray
{
    /**  @phpstan-return array<Key, Value> */
    public function toNativeArray(): array;
}
