<?php declare(strict_types = 1);

namespace Hydrogen\Vocab\Native\String\BinaryString\Sanitisers;

use Hydrogen\Contract\Sanitiser;
use Override;
use Stringable;

/**
 * @phpstan-implements Sanitiser<mixed>
 */
class Trim implements Sanitiser
{
    public function __construct(
        public readonly string $characters = " \n\r\t\v\x00",
        public readonly ?string $extra_characters = null,
        public readonly bool $stringify = true
    )
    {
    }

    #[Override]
    public function __invoke(mixed $value): mixed
    {
        if (!is_string($value) && !$this->stringify) {
            return $value;
        }

        if (is_object($value) && $value instanceof Stringable) {
            $value = (string) $value;
        } elseif (!is_scalar($value)) {
            return $value;
        }

        $value = (string) $value;

        $trim_chars = $this->characters . ($this->extra_characters ?? '');

        return $this->trim($value, $trim_chars);
    }

    protected function trim(string $value, string $characters): string
    {
        return trim($value, $characters);
    }
}
