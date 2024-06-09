<?php

declare(strict_types=1);

namespace Hydrogen\Contract;

/**
 * @phpstan-template T
 *
 * @phpstan-extends Transformer<T, T>
 *
 * @api
 */
interface Patch extends Transformer
{
}
