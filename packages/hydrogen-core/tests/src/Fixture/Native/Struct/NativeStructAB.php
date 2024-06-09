<?php

declare(strict_types=1);

namespace Hydrogen\Tests\Fixture\Native\Struct;

/**
 * Plain Old PHP Object (AB)
 */
readonly class NativeStructAB extends NativeStructA
{
    public function __construct(
        bool $boolean = false,
        ?bool $nullableBoolean = null,
        public int $integer = 0,
        public ?int $nullableInteger = null
    ) {
        parent::__construct(
            boolean: $boolean,
            nullableBoolean: $nullableBoolean
        );
    }
}
