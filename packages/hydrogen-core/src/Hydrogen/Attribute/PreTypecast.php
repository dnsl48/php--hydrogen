<?php declare(strict_types = 1);

namespace Hydrogen\Attribute;

use Attribute;
use Hydrogen\Contract\Patch;
use Hydrogen\Contract\Transformer;

#[Attribute(Attribute::IS_REPEATABLE | Attribute::TARGET_PARAMETER | Attribute::TARGET_PROPERTY | Attribute::TARGET_CLASS)]
class PreTypecast
{
    public function __construct(
        /** @phpstan-var Transformer<mixed, mixed> */
        public readonly Transformer $transformer
    )
    {
    }
}
