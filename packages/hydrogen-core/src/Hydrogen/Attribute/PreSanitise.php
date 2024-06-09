<?php

declare(strict_types=1);

namespace Hydrogen\Attribute;

use Attribute;
use Hydrogen\Contract\Sanitiser;

/**
 * @phpstan-template T
 */
#[Attribute(
    Attribute::IS_REPEATABLE | Attribute::TARGET_PARAMETER | Attribute::TARGET_PROPERTY | Attribute::TARGET_CLASS
)]
readonly class PreSanitise
{
    /**
     * @phpstan-param Sanitiser<T> $sanitiser
     */
    public function __construct(
        public Sanitiser $sanitiser,
    ) {
    }
}
