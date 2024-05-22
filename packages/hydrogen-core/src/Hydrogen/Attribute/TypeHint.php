<?php declare(strict_types = 1);

namespace Hydrogen\Attribute;

use Attribute;

#[Attribute(Attribute::TARGET_PARAMETER | Attribute::TARGET_PROPERTY)]
class TypeHint
{
    public function __construct(public readonly string $typeValue)
    {
    }
}