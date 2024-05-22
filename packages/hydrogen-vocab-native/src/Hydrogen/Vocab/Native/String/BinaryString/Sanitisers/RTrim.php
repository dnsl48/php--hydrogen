<?php declare(strict_types = 1);

namespace Hydrogen\Vocab\Native\String\BinaryString\Sanitisers;
use Override;

class RTrim extends Trim
{
    #[Override]
    protected function trim(string $value, string $characters): string
    {
        return rtrim($value, $characters);
    }
}
