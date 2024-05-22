<?php declare(strict_types = 1);

namespace Hydrogen\Vocab\Native\Decimal;

use Hydrogen\Exception\DataContainerException;
use Hydrogen\Exception\DataSanitisationException;
use Hydrogen\Exception\DataTypecastException;
use Hydrogen\Exception\DataValidationException;
use Hydrogen\Value\AbstractValue;
use Hydrogen\Value\Contract\Typecast\ToNativeFloat;
use Hydrogen\Value\Trait\GenericSerialisationFallbacks;
use Hydrogen\Vocab\Native\Decimal\NativeFloat\Trait\NativeFloatContracts;
use Override;

/**
 * @phpstan-extends AbstractValue<mixed, mixed, float, float, float>
 */
class NativeFloat extends AbstractValue implements ToNativeFloat
{
    use GenericSerialisationFallbacks;
    use NativeFloatContracts;

    #[Override]
    public function toNativeFloat(): float
    {
        return $this->valueContainer->getValue();
    }

    /**
     * @throws DataContainerException
     * @throws DataTypecastException
     * @throws DataSanitisationException
     * @throws DataValidationException
     */
    public function negate(): NativeFloat
    {
        return new static(-$this->toNativeFloat());
    }
}
