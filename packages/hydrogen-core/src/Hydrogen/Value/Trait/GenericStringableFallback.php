<?php

declare(strict_types=1);

namespace Hydrogen\Value\Trait;

use Hydrogen\Exception\LogicException;
use JsonSerializable;
use Override;

/**
 * @phpstan-require-implements JsonSerializable
 */
trait GenericStringableFallback
{
    /**
     * @throws LogicException When could not stringify the value
     */
    #[Override]
    public function __toString(): string
    {
        $value = json_encode($this->jsonSerialize());
        if (false === $value) {
            throw new LogicException('Could not stringify the JSON data');
        } else {
            return $value;
        }
    }
}
