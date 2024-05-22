<?php declare(strict_types = 1);

namespace Hydrogen\Value\Contract\Mission;

use Hydrogen\Exception\DataContainerException;
use Hydrogen\Value\Contract\Container\ValueContainer;

/**
 * @phpstan-template T
 *
 * @api
 */
interface ValueContaineriser
{
    /**
     * @phpstan-param T $value 
     *
     * @phpstan-return ValueContainer<T>
     *
     * @phpstan-throws DataContainerException<T>
     *
     * @throws DataContainerException
     */
    public function __invoke(mixed $value): ValueContainer;
}