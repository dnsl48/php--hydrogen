<?php declare(strict_types = 1);

namespace Hydrogen\Vocab\Native\Integer;

use Hydrogen\Value\AbstractValue;
use Hydrogen\Value\Contract\Typecast\ToNativeInt;
use Hydrogen\Value\Trait\GenericSerialisationFallbacks;
use Hydrogen\Vocab\Native\Integer\NativeInt\Trait\NativeIntContracts;
use Override;

/**
 * @phpstan-extends AbstractValue<mixed, mixed, int, int, int>
 */
class NativeInt extends AbstractValue implements ToNativeInt
{
    use GenericSerialisationFallbacks;
    use NativeIntContracts;

    #[Override]
    public function toNativeInt(): int
    {
        $value = $this->valueContainer->getValue();
        assert(is_int($value));
        return $value;
    }
}
