<?php

declare(strict_types=1);

namespace Hydrogen\Tests\Fixture\Native\Struct;

readonly class NativeStructD
{
    public function __construct(
        public string $string = '',
        public ?string $nullableString = null
    ) {
    }
}
