<?php declare(strict_types = 1);

namespace Tests\Fixture\Native\Struct;

class NativeStructD
{
    public function __construct(
        public readonly string $string = '',
        public readonly ?string $nullableString = null
    )
    {
    }
}