<?php

declare(strict_types=1);

namespace Hydrogen\Tests\Fixture\Native\Struct;

/**
 * Plain Old PHP Object (B)
 */
readonly class NativeStructB
{
    public function __construct(
        public int $integer = 0,
        public ?int $nullableInteger = null
    ) {
    }
}
