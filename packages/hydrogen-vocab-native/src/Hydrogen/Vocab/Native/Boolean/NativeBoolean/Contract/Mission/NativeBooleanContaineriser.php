<?php declare(strict_types = 1);

namespace Hydrogen\Vocab\Native\Boolean\NativeBoolean\Contract\Mission;
use Hydrogen\Value\Contract\Mission\ValueContaineriser;
use Hydrogen\Vocab\Native\Boolean\NativeBoolean\Contract\Container\NativeBooleanValueContainer;
use Override;

/**
 * @phpstan-implements ValueContaineriser<mixed>
 */
class NativeBooleanContaineriser implements ValueContaineriser
{
    /**
     * @phpstan-template T
     * @phpstan-param T $value
     * @phpstan-return NativeBooleanValueContainer<T>
     */
    #[Override]
    public function __invoke(mixed $value): NativeBooleanValueContainer
    {
        /** @var NativeBooleanValueContainer<T> */
        return new NativeBooleanValueContainer($value);
    }
}
