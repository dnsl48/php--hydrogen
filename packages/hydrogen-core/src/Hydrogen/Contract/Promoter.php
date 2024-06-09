<?php

declare(strict_types=1);

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
}
