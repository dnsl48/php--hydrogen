<?php declare(strict_types = 1);

namespace Hydrogen\Vocab\Native\Decimal\NativeFloat\Trait;

use Hydrogen\Exception\DataContainerException;
use Hydrogen\Vocab\Native\Decimal\NativeFloat\Contract\Container\NativeFloatValueContainer;
use Hydrogen\Vocab\Native\Decimal\NativeFloat\Contract\Mission\NativeFloatContaineriser;
use Override;

trait NativeFloatContainerise
{
    /**
     * @phpstan-return NativeFloatValueContainer<mixed>
     *
     * @phpstan-throws DataContainerException<mixed>
     *
     * @throws DataContainerException
     */
    #[Override]
    protected function containerise(mixed $value): NativeFloatValueContainer
    {
        static $nativeFloatContaineriser = new NativeFloatContaineriser();
        assert($nativeFloatContaineriser instanceof NativeFloatContaineriser);
        return $nativeFloatContaineriser($value);
    }
}
