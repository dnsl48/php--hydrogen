<?php declare(strict_types = 1);

namespace Hydrogen\Value\Contract\Mission;

use Hydrogen\Exception\DataTypecastException;
use Hydrogen\Value\Contract\Container\TypecastedValueContainer;
use Hydrogen\Value\Contract\Container\ValueContainer;

/**
 * @phpstan-template TInput
 * @phpstan-template TCasted
 *
 * @api
 */
interface ValueContainerTypecaster
{
    /**
     * @phpstan-param ValueContainer<TInput> $valueContainer
     *
     * @phpstan-return TypecastedValueContainer<TCasted>
     *
     * @phpstan-throws DataTypecastException<TInput>
     * @throws DataTypecastException
     */
    public function __invoke(ValueContainer $valueContainer): TypecastedValueContainer;
}