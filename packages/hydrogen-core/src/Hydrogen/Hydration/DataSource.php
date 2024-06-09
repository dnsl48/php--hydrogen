<?php

declare(strict_types=1);

namespace Hydrogen\Hydration;

use Hydrogen\Exception\DataHydrationException;
use ReflectionProperty;

/**
 * @api
 */
interface DataSource
{
    /**
     * Returns true if the data source contains an instance of the
     * class given.
     *
     * @phpstan-param class-string $fqcn Fully Qualified Class Name (including namespace)
     * @param string $fqcn Fully Qualified Class Name (including namespace)
     *
     * @return bool true if an instance of the class is present in the data source
     */
    public function containsInstanceOf(string $fqcn): bool;

    /**
     * @phpstan-throws DataHydrationException<array{self, ReflectionProperty}>
     * @throws DataHydrationException
     */
    public function fetchPropertyValue(ReflectionProperty $property): mixed;

    /**
     * Returns true if the data source contains a value for the
     * name given.
     *
     * @param string $name Name of the value to check
     *
     * @return bool true if the data source has a value for the name
     */
    public function hasValueForName(string $name): bool;

    /**
     * Returns true if the data source contains a value for the
     * name given.
     *
     * @param string $name Name of the value to check
     *
     * @return mixed value for the given name
     *
     * @phpstan-throws DataHydrationException<array{self, string}>
     * @throws DataHydrationException
     */
    public function fetchValueForName(string $name): mixed;
}
