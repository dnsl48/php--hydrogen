<?php declare(strict_types = 1);

namespace Tests\Fixture\Native\Struct;

class NativeStruct
{
    public function __construct(
        public readonly float $float = 0,
        public readonly ?float $nullableFloat = null
    )
    {
    }
}