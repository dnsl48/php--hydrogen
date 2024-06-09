<?php

declare(strict_types=1);

namespace Hydrogen\Tests\Fixture\Native\Struct;

/**
 * Plain Old PHP Object (A)
 */
readonly class NativeStructA
{
    public function __construct(
        public bool $boolean = false,
        public ?bool $nullableBoolean = null
    ) {
    }
}
