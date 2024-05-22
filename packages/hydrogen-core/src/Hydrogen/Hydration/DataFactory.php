<?php declare(strict_types = 1);

namespace Hydrogen\Hydration;

use Hydrogen\Exception\HydrogenException;

/**
 * @phpstan-template T
 *
 * @api
 */
interface DataFactory
{
    /**
     * @phpstan-return T
     *
     * @throws HydrogenException
     */
    public function instantiate(): mixed;
}