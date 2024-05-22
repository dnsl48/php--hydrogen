<?php declare(strict_types = 1);

namespace Tests\Fixture\Native\Struct;

use Tests\Fixture\Native\Enum\NativeEnumA;

class NativeStructE
{
    public function __construct(
        public readonly NativeEnumA $basicEnumA = NativeEnumA::VariantA,
        public readonly ?NativeEnumA $nullableBasicEnumA = null
    )
    {
    }
}