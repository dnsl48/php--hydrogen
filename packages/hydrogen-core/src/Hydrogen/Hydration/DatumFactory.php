<?php

declare(strict_types=1);

namespace Hydrogen\Hydration;

use Hydrogen\Exception\HydrogenException;
use Override;

/**
 * @phpstan-template T of object
 * @phpstan-extends DataFactory<T>
 *
 * @api
 */
interface DatumFactory extends DataFactory
{
    /**
     * @phpstan-return T
     *
     * @throws HydrogenException
     */
    #[Override]
    public function instantiate(): object;
}
