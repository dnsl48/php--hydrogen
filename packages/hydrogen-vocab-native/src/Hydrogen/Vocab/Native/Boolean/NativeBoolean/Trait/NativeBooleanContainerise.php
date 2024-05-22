<?php declare(strict_types = 1);

namespace Hydrogen\Vocab\Native\Boolean\NativeBoolean\Trait;

use Hydrogen\Exception\DataContainerException;
use Hydrogen\Vocab\Native\Boolean\NativeBoolean\Contract\Container\NativeBooleanValueContainer;
use Hydrogen\Vocab\Native\Boolean\NativeBoolean\Contract\Mission\NativeBooleanContaineriser;
use Override;

trait NativeBooleanContainerise
{
    /**
     * @phpstan-return NativeBooleanValueContainer<mixed>
     *
     * @phpstan-throws DataContainerException<mixed>
     *
     * @throws DataContainerException
     */
    #[Override]
    protected function containerise(mixed $value): NativeBooleanValueContainer
    {
        static $nativeBooleanContaineriser = new NativeBooleanContaineriser();
        assert($nativeBooleanContaineriser instanceof NativeBooleanContaineriser);
        return $nativeBooleanContaineriser($value);
    }
}
