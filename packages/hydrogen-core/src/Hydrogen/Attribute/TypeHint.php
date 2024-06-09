<?php

declare(strict_types=1);

namespace Hydrogen\Attribute;

use Attribute;

#[Attribute(Attribute::TARGET_PARAMETER | Attribute::TARGET_PROPERTY)]
readonly class TypeHint
{
    public function __construct(public string $typeValue)
    {
    }
}
