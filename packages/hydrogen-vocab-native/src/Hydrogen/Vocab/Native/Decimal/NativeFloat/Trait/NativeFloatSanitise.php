<?php

declare(strict_types=1);

namespace Hydrogen\Vocab\Native\Decimal\NativeFloat\Trait;

use Hydrogen\Exception\DataSanitisationException;
use Hydrogen\Value\Contract\Container\TypecastedValueContainer;
use Hydrogen\Vocab\Native\Decimal\NativeFloat\Contract\Container\NativeFloatCastedValue;
use Hydrogen\Vocab\Native\Decimal\NativeFloat\Contract\Container\NativeFloatSanitisedValue;
use Hydrogen\Vocab\Native\Decimal\NativeFloat\Contract\Mission\NativeFloatSanitiser;
use Override;

trait NativeFloatSanitise
{
    /**
     * @phpstan-param TypecastedValueContainer<float> $valueContainer
     *
     * @phpstan-assert NativeFloatCastedValue $valueContainer
     *
     * @throws DataSanitisationException
     */
    #[Override]
    protected function sanitise(TypecastedValueContainer $valueContainer): NativeFloatSanitisedValue
    {
        static $nativeFloatSanitiser = new NativeFloatSanitiser();
        assert($nativeFloatSanitiser instanceof NativeFloatSanitiser);
        return $nativeFloatSanitiser($valueContainer);
    }
}
