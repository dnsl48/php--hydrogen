<?php

declare(strict_types=1);

namespace Hydrogen\Value\Trait;

use Hydrogen\Value\Contract\Container\ValueContainer;

/**
 * @phpstan-require-implements ValueContainer
 */
trait GenericSerialisationFallbacks
{
    use GenericJsonSerializeFallback;
    use GenericStringableFallback;
}
