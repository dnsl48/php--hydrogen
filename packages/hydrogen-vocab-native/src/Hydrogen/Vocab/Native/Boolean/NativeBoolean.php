<?php declare(strict_types = 1);

namespace Hydrogen\Vocab\Native\Boolean;

use Hydrogen\Value\AbstractValue;
use Hydrogen\Value\Contract\Typecast\ToNativeBool;
use Hydrogen\Value\Trait\GenericSerialisationFallbacks;
use Hydrogen\Vocab\Native\Boolean\NativeBoolean\Trait\NativeBooleanContracts;
use Override;

/**
 * @phpstan-extends AbstractValue<mixed, mixed, bool, bool, bool>
 */
class NativeBoolean extends AbstractValue implements ToNativeBool
{
    use GenericSerialisationFallbacks;
    use NativeBooleanContracts;

    #[Override]
    public function toNativeBool(): bool
    {
        return $this->valueContainer->getValue();
    }
}
