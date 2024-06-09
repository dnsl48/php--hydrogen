<?php

declare(strict_types=1);

namespace Hydrogen\Vocab\Native\String\BinaryString\Trait;

use Hydrogen\Exception\DataTypecastException;
use Hydrogen\Value\Contract\Container\ValueContainer;
use Hydrogen\Vocab\Native\String\BinaryString\Contract\Container\BinaryStringCastedValue;
use Hydrogen\Vocab\Native\String\BinaryString\Contract\Mission\BinaryStringTypecaster;
use Override;

trait BinaryStringTypecast
{
    /**
     * @throws DataTypecastException
     */
    #[Override]
    protected function typecast(ValueContainer $valueContainer): BinaryStringCastedValue
    {
        static $binaryStringTypecaster = new BinaryStringTypecaster();
        assert($binaryStringTypecaster instanceof BinaryStringTypecaster);
        return $binaryStringTypecaster($valueContainer);
    }
}
