<?php

declare(strict_types=1);

namespace Hydrogen\Vocab\Native\Decimal\NativeFloat\Trait;

use Hydrogen\Exception\DataTypecastException;
use Hydrogen\Value\Contract\Container\ValueContainer;
use Hydrogen\Vocab\Native\Decimal\NativeFloat\Contract\Container\NativeFloatCastedValue;
use Hydrogen\Vocab\Native\Decimal\NativeFloat\Contract\Container\NativeFloatValueContainer;
use Hydrogen\Vocab\Native\Decimal\NativeFloat\Contract\Mission\NativeFloatTypecaster;
use Override;

trait NativeFloatTypecast
{
    /**
     * @phpstan-param ValueContainer<mixed> $valueContainer
     *
     * @phpstan-assert NativeFloatValueContainer<mixed> $valueContainer
     *
     * @throws DataTypecastException
     */
    #[Override]
    protected function typecast(ValueContainer $valueContainer): NativeFloatCastedValue
    {
        static $nativeFloatTypecaster = new NativeFloatTypecaster();
        assert($nativeFloatTypecaster instanceof NativeFloatTypecaster);
        return $nativeFloatTypecaster($valueContainer);
    }
}
