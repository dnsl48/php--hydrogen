<?php declare(strict_types = 1);

namespace Hydrogen\Vocab\Native\String\BinaryString\Nullifyers;

use Hydrogen\Value\Contract\Typecast\Nullify;
use Override;
use Stringable;

/**
 * @phpstan-implements Nullify<mixed>
 */
class EmptyString implements Nullify
{
    public function __construct(public readonly bool $trim = true)
    {
    }

    #[Override]
    public function is_null(mixed $value): bool
    {
        if (!is_string($value) && !$value instanceof Stringable) {
            return false;
        }

        $value = (string) $value;

        return strlen($this->trim ? trim($value) : $value) > 0 ? false : true;
    }

    #[Override]
    public function __invoke(mixed $value): mixed
    {
        return $this->is_null($value) ? null : $value;
    }
}
