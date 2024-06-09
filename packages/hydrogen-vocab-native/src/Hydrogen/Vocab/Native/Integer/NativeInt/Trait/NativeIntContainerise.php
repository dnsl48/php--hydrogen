<?php

declare(strict_types=1);

namespace Hydrogen\Vocab\Native\Integer\NativeInt\Trait;

use Hydrogen\Exception\DataContainerException;
use Hydrogen\Vocab\Native\Integer\NativeInt\Contract\Container\NativeIntValueContainer;
use Hydrogen\Vocab\Native\Integer\NativeInt\Contract\Mission\NativeIntContaineriser;
use Override;

trait NativeIntContainerise
{
    /**
     * @phpstan-return NativeIntValueContainer<mixed>
     *
     * @phpstan-throws DataContainerException<mixed>
     */
    #[Override]
    protected function containerise(mixed $value): NativeIntValueContainer
    {
        static $nativeIntContaineriser = new NativeIntContaineriser();
        assert($nativeIntContaineriser instanceof NativeIntContaineriser);
        return $nativeIntContaineriser($value);
    }
}
