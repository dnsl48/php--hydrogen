<?php

declare(strict_types=1);

namespace Hydrogen\Vocab\Native\String\BinaryString\Nullify;

use Hydrogen\Value\Contract\Typecast\Nullify;
use Override;
use Stringable;

/**
 * @phpstan-implements Nullify<mixed>
 */
readonly class EmptyString implements Nullify
{
    public function __construct(public bool $trim = true)
    {
    }

    #[Override]
    public function isNull(mixed $value): bool
    {
        if (!is_string($value) && !$value instanceof Stringable) {
            return false;
        }

        $value = (string) $value;
        $processed_value = $this->trim ? trim($value) : $value;

        return strlen($processed_value) === 0;
    }

    #[Override]
    public function __invoke(mixed $value): mixed
    {
        return $this->isNull($value) ? null : $value;
    }
}
