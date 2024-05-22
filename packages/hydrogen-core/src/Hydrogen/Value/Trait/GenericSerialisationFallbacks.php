<?php declare(strict_types = 1);

namespace Hydrogen\Value\Trait;
use Hydrogen\Value\Contract\Container\ValueContainer;
use Override;

/**
 * @phpstan-require-implements ValueContainer
 */
trait GenericSerialisationFallbacks
{
    use GenericJsonSerializeFallback;
    use GenericStringableFallback;
}
