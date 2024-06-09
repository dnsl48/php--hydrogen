<?php

declare(strict_types=1);

namespace Hydrogen\Hydration\DataFactory;

use Hydrogen\Hydration\DataFactory;
use Hydrogen\Hydration\DataSource;

/**
 * @phpstan-template T
 */
abstract class DataFactoryProvider
{
    /**
     * @phpstan-return DataFactory<T>
     */
    abstract public function __invoke(DataSource $dataSource): DataFactory;
}
