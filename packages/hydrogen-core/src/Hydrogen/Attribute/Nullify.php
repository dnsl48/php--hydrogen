<?php declare(strict_types = 1);

namespace Hydrogen\Attribute;

use Attribute;
use Hydrogen\Attribute\Nullify\Stage;
use Hydrogen\Value\Contract\Typecast\Nullify as NullifyTypecast;

/**
 * @phpstan-template T
 */
#[Attribute(Attribute::IS_REPEATABLE | Attribute::TARGET_PARAMETER | Attribute::TARGET_PROPERTY | Attribute::TARGET_CLASS)]
class Nullify
{
    public function __construct(
        /** @phpstan-var NullifyTypecast<T> */
        public readonly NullifyTypecast $typecast,
        public readonly Stage $nullifyStage = Stage::ALL
    )
    {
    }
}
