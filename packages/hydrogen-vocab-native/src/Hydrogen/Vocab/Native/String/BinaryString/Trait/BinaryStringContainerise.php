<?php

declare(strict_types=1);

namespace Hydrogen\Vocab\Native\String\BinaryString\Trait;

use Hydrogen\Exception\DataContainerException;
use Hydrogen\Vocab\Native\String\BinaryString\Contract\Container\BinaryStringValueContainer;
use Hydrogen\Vocab\Native\String\BinaryString\Contract\Mission\BinaryStringContaineriser;
use Override;

trait BinaryStringContainerise
{
    /**
     * @phpstan-return BinaryStringValueContainer<mixed>
     *
     * @phpstan-throws DataContainerException<mixed>
     */
    #[Override]
    protected function containerise(mixed $value): BinaryStringValueContainer
    {
        static $binaryStringContaineriser = new BinaryStringContaineriser();
        assert($binaryStringContaineriser instanceof BinaryStringContaineriser);
        return $binaryStringContaineriser($value);
    }
}
