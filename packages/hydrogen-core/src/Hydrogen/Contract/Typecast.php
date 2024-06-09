<?php

declare(strict_types=1);

namespace Hydrogen\Contract;

/**
 * @phpstan-template T
 * @phpstan-template R
 * @phpstan-extends Transformer<T, R>
 *
 * @api
 */
interface Typecast extends Transformer
{
}
