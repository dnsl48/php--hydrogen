<?php declare(strict_types = 1);

namespace Tests\Fixture\Value\NaiveValueObject;

use Hydrogen\Contract\Patch;
use Hydrogen\Contract\Transformer;
use Hydrogen\Value\Contract\Container\ValueContainer;
use Override;

/**
 * @phpstan-implements ValueContainer<mixed>
 */
class NaiveValueContainer implements ValueContainer
{
    public function __construct(public readonly mixed $value)
    {
    }

    #[Override]
    public function transform(Transformer $transformer): ValueContainer
    {
        return new self($transformer($this->getValue()));
    }

    #[Override]
    public function getValue(): mixed {
        return $this->value;
    }
}