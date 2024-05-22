<?php declare(strict_types = 1);

namespace Hydrogen\Hydration\DatumFactory;

use Hydrogen\Hydration\DatumFactory;
use Hydrogen\Hydration\DataSource;

/**
 * @phpstan-template T of object
 */
abstract class DatumFactoryProvider
{
    /**
     * @phpstan-return DatumFactory<T>
     */
    abstract public function __invoke(DataSource $dataSource): DatumFactory;
}