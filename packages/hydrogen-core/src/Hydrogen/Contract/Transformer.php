<?php declare(strict_types = 1);

namespace Hydrogen\Contract;

/**
 * @phpstan-template T
 * @phpstan-template R
 *
 * @api
 */
interface Transformer {
    /**
     * @phpstan-param T $value Initial value prior to the transformation
     * @phpstan-return R Resulting value after the transformation applied
     */
    public function __invoke(mixed $value): mixed;
}