<?php

declare(strict_types=1);

namespace Hydrogen\Vocab\Native\Boolean\NativeBoolean\Trait;

use Hydrogen\Exception\DataTypecastException;
use Hydrogen\Value\Contract\Container\ValueContainer;
use Hydrogen\Vocab\Native\Boolean\NativeBoolean\Contract\Container\NativeBooleanCastedValue;
use Hydrogen\Vocab\Native\Boolean\NativeBoolean\Contract\Container\NativeBooleanValueContainer;
use Hydrogen\Vocab\Native\Boolean\NativeBoolean\Contract\Mission\NativeBooleanTypecaster;
use Override;

trait NativeBooleanTypecast
{
    /**
     * @phpstan-param ValueContainer<mixed> $valueContainer
     *
     * @phpstan-assert NativeBooleanValueContainer<mixed> $valueContainer
     *
     * @throws DataTypecastException
     */
    #[Override]
    protected function typecast(ValueContainer $valueContainer): NativeBooleanCastedValue
    {
        static $nativeBooleanTypecaster = new NativeBooleanTypecaster();
        assert($nativeBooleanTypecaster instanceof NativeBooleanTypecaster);
        return $nativeBooleanTypecaster($valueContainer);
    }
}
