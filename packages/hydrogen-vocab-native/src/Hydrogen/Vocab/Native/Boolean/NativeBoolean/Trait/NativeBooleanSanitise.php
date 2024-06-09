<?php

declare(strict_types=1);

namespace Hydrogen\Vocab\Native\Boolean\NativeBoolean\Trait;

use Hydrogen\Exception\DataSanitisationException;
use Hydrogen\Value\Contract\Container\TypecastedValueContainer;
use Hydrogen\Vocab\Native\Boolean\NativeBoolean\Contract\Container\NativeBooleanCastedValue;
use Hydrogen\Vocab\Native\Boolean\NativeBoolean\Contract\Container\NativeBooleanSanitisedValue;
use Hydrogen\Vocab\Native\Boolean\NativeBoolean\Contract\Mission\NativeBooleanSanitiser;
use Override;

trait NativeBooleanSanitise
{
    /**
     * @phpstan-param TypecastedValueContainer<bool> $valueContainer
     *
     * @phpstan-assert NativeBooleanCastedValue $valueContainer
     *
     * @throws DataSanitisationException
     */
    #[Override]
    protected function sanitise(TypecastedValueContainer $valueContainer): NativeBooleanSanitisedValue
    {
        static $nativeBooleanSanitiser = new NativeBooleanSanitiser();
        assert($nativeBooleanSanitiser instanceof NativeBooleanSanitiser);
        return $nativeBooleanSanitiser($valueContainer);
    }
}
