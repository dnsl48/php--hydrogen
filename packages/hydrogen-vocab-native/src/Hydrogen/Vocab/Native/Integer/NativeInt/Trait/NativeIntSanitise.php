<?php declare(strict_types = 1);

namespace Hydrogen\Vocab\Native\Integer\NativeInt\Trait;

use Hydrogen\Exception\DataSanitisationException;
use Hydrogen\Value\Contract\Container\TypecastedValueContainer;
use Hydrogen\Vocab\Native\Integer\NativeInt\Contract\Container\NativeIntCastedValue;
use Hydrogen\Vocab\Native\Integer\NativeInt\Contract\Container\NativeIntSanitisedValue;
use Hydrogen\Vocab\Native\Integer\NativeInt\Contract\Mission\NativeIntSanitiser;
use Override;

trait NativeIntSanitise
{
    /**
     * @phpstan-param TypecastedValueContainer<int> $valueContainer
     *
     * @phpstan-assert NativeIntCastedValue $valueContainer
     *
     * @throws DataSanitisationException
     */
    #[Override]
    protected function sanitise(TypecastedValueContainer $valueContainer): NativeIntSanitisedValue
    {
        static $nativeIntSanitiser = new NativeIntSanitiser();
        assert($nativeIntSanitiser instanceof NativeIntSanitiser);
        return $nativeIntSanitiser($valueContainer);
    }
}