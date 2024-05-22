<?php declare(strict_types = 1);

namespace Hydrogen\Contract;

/**
 * @phpstan-template T
 * @phpstan-template R of T
 *
 * @phpstan-extends Transformer<T, R>
 *
 * @api
 */
interface Promoter extends Transformer
{
    // /**
    //  * @phpstan-param T $value
    //  * @phpstan-return R
    //  */
    // public function __invoke(mixed $value): mixed;
}