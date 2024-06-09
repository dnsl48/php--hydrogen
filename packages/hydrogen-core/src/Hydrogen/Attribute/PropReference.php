<?php

declare(strict_types=1);

namespace Hydrogen\Attribute;

use Attribute;

#[Attribute(
    Attribute::IS_REPEATABLE | Attribute::TARGET_PARAMETER | Attribute::TARGET_PROPERTY | Attribute::TARGET_CLASS
)]
readonly class PropReference
{
    public function __construct(
        public string $className,
        public string $fieldName
    ) {
    }
}
