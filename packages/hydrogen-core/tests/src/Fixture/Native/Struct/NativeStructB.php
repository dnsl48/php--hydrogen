<?php declare(strict_types = 1);

namespace Tests\Fixture\Native\Struct;

/**
 * Plain Old PHP Object (B)
 */
class NativeStructB
{
    public function __construct(
        public readonly int $integer = 0,
        public readonly ?int $nullableInteger = null
    )
    {
    }
}