<?php

declare(strict_types=1);

namespace Hydrogen\Value\Trait;

use BackedEnum;
use Hydrogen\Exception\LogicException;
use Hydrogen\Value\Contract\Container\ValueContainer;
use JsonSerializable;
use Override;
use Stringable;

/**
 * @phpstan-require-implements ValueContainer
 */
trait GenericJsonSerializeFallback
{
    /**
     * @throws LogicException when the value is unserializable
     */
    #[Override]
    public function jsonSerialize(): mixed
    {
        // $value = $this->valueContainer->getValue();
        $value = $this->getValue();

        if (null === $value) {
            return null;
        } elseif (is_scalar($value)) {
            return $value;
        } elseif ($value instanceof JsonSerializable) {
            return $value->jsonSerialize();
        } elseif ($value instanceof Stringable) {
            return (string) $value;
        } elseif ($value instanceof BackedEnum) {
            return $value->value;
        } else {
            throw new LogicException(sprintf('Unserializable type: %s', get_debug_type($value)));
        }
    }
}
