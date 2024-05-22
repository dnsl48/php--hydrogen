<?php declare(strict_types = 1);

namespace Hydrogen\Vocab\Native\String\BinaryString\Trait;

use Hydrogen\Exception\DataSanitisationException;
use Hydrogen\Value\Contract\Container\TypecastedValueContainer;
use Hydrogen\Vocab\Native\String\BinaryString\Contract\Container\BinaryStringSanitisedValue;
use Hydrogen\Vocab\Native\String\BinaryString\Contract\Mission\BinaryStringSanitiser;
use Override;

trait BinaryStringSanitise
{
    /**
     * @phpstan-throws DataSanitisationException<string>
     *
     * @throws DataSanitisationException 
     */
    #[Override]
    protected function sanitise(TypecastedValueContainer $valueContainer): BinaryStringSanitisedValue {
        /** @phpstan-var BinaryStringSanitiser */
        static $binaryStringSanitiser = new BinaryStringSanitiser();
        return $binaryStringSanitiser($valueContainer);
    }
}