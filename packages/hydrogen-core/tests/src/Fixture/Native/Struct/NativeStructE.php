<?php

declare(strict_types=1);

namespace Hydrogen\Tests\Fixture\Native\Struct;

use Hydrogen\Tests\Fixture\Native\Enum\NativeEnumA;

readonly class NativeStructE
{
    public function __construct(
        public NativeEnumA $basicEnumA = NativeEnumA::VariantA,
        public ?NativeEnumA $nullableBasicEnumA = null
    ) {
    }
}
