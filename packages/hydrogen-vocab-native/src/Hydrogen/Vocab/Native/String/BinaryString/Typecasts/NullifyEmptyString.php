<?php

declare(strict_types=1);

namespace Hydrogen\Vocab\Native\String\BinaryString\Typecasts;

use Hydrogen\Contract\Typecast;
use Override;

/**
 * @phpstan-implements Typecast<string, ?string>
 */
readonly class NullifyEmptyString implements Typecast
{
    public function __construct(public bool $trim = true)
    {
    }

    #[Override]
    public function __invoke(mixed $value): mixed
    {
        return match (is_string($value)) {
            true => strlen($this->trim ? trim($value) : $value) > 0 ? $value : null,
            default => $value
        };
    }
}
