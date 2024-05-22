<?php declare(strict_types = 1);

namespace Hydrogen\Vocab\Native\Integer\NativeInt\Trait;

use Hydrogen\Exception\DataContainerException;
use Hydrogen\Exception\DataTypecastException;
use Hydrogen\Value\Contract\Container\ValueContainer;
use Hydrogen\Vocab\Native\Integer\NativeInt\Contract\Container\NativeIntCastedValue;
use Hydrogen\Vocab\Native\Integer\NativeInt\Contract\Mission\NativeIntTypecaster;
use Override;

trait NativeIntTypecast
{
    /**
     * @phpstan-param ValueContainer<mixed> $valueContainer
     * 
     * @phpstan-assert NativeIntValueContainer<mixed> $valueContainer
     *
     * @throws DataTypecastException
     */
    #[Override]
    protected function typecast(ValueContainer $valueContainer): NativeIntCastedValue
    {
        static $nativeIntTypecaster = new NativeIntTypecaster();
        assert($nativeIntTypecaster instanceof NativeIntTypecaster);
        return $nativeIntTypecaster($valueContainer);
    }
}