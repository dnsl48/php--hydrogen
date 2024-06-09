<?php

declare(strict_types=1);

namespace Hydrogen\Tests\Fixture\Value\NaiveValueObject;

use Hydrogen\Value\Contract\Container\SanitisedValueContainer;
use Hydrogen\Value\Contract\Container\TypecastedValueContainer;
use Hydrogen\Value\Contract\Container\ValidatedValueContainer;
use Hydrogen\Value\Contract\Container\ValueContainer;
use Override;

trait NaiveValueContracts
{
    #[Override]
    protected function containerise(mixed $value): NaiveValueContainer
    {
        if ($value instanceof NaiveValueContainer) {
            return $value;
        } elseif ($value instanceof ValueContainer) {
            return new NaiveValueContainer($value->getValue());
        } else {
            return new NaiveValueContainer($value);
        }
    }

    #[Override]
    protected function typecast(ValueContainer $value): TypecastedValueContainer
    {
        return new TypecastedNaiveValueContainer($value->getValue());
    }

    #[Override]
    protected function sanitise(TypecastedValueContainer $value): SanitisedValueContainer
    {
        return new SanitisedNaiveValueContainer($value->getValue());
    }

    #[Override]
    protected function validate(SanitisedValueContainer $value): ValidatedValueContainer
    {
        return new ValidatedNaiveValueContainer($value->getValue());
    }
}
