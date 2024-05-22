<?php declare(strict_types = 1);

namespace Tests\Fixture\Native\Struct;

/**
 * Plain Old PHP Object (AB)
 */
class NativeStructAB extends NativeStructA
{
    public function __construct(
        bool $boolean = false,
        ?bool $nullableBoolean = null,
        public readonly int $integer = 0,
        public readonly ?int $nullableInteger = null
    )
    {
        parent::__construct(
            boolean: $boolean,
            nullableBoolean: $nullableBoolean
        );
    }
}
