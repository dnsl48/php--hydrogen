<?php declare(strict_types = 1);

namespace Hydrogen\Value\Sanitiser;

use Hydrogen\Value\Sanitiser;
use Override;

/**
 * @template TValue
 * @template TResult
 *
 * @implements Sanitiser<TValue, TResult>
 */
abstract class AbstractSanitiser implements Sanitiser
{
    #[Override]
    public function __construct(
        /** @var TValue */
        protected mixed $value
    )
    {
    }
}
