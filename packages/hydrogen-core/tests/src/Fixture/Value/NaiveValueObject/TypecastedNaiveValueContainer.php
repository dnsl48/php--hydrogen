<?php declare(strict_types = 1);

namespace Tests\Fixture\Value\NaiveValueObject;

use Hydrogen\Contract\Sanitiser;
use Hydrogen\Value\Contract\Container\TypecastedValueContainer;
use Override;

/**
 * @phpstan-template T
 * @phpstan-implements TypecastedValueContainer<T>
 */
class TypecastedNaiveValueContainer extends NaiveValueContainer implements TypecastedValueContainer
{
    /**
     * @phpstan-param Sanitiser<T> $sanitiser
     * @phpstan-return TypecastedNaiveValueContainer<T>
     */
    #[Override]
    public function preSanitise(Sanitiser $sanitiser): TypecastedNaiveValueContainer
    {
        /** @phpstan-var TypecastedNaiveValueContainer<T> */
        return new self($sanitiser($this->getValue()));
    }
}