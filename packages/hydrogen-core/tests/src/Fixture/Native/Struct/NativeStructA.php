<?php declare(strict_types = 1);

namespace Tests\Fixture\Native\Struct;

/**
 * Plain Old PHP Object (A)
 */
class NativeStructA
{
    public function __construct(
        public readonly bool $boolean = false,
        public readonly ?bool $nullableBoolean = null
    )
    {
    }
}