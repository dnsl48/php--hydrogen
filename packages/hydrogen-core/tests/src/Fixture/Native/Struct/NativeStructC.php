<?php

declare(strict_types=1);

namespace Hydrogen\Tests\Fixture\Native\Struct;

readonly class NativeStructC
{
    public function __construct(
        public float $float = 0,
        public ?float $nullableFloat = null
    ) {
    }
}
