<?php declare(strict_types = 1);

namespace Hydrogen\Attribute;

use Attribute;

#[Attribute(Attribute::IS_REPEATABLE | Attribute::TARGET_PARAMETER | Attribute::TARGET_PROPERTY | Attribute::TARGET_CLASS)]
class PropReference
{
    public function __construct(
        public readonly string $className,
        public readonly string $fieldName
    )
    {
    }
}