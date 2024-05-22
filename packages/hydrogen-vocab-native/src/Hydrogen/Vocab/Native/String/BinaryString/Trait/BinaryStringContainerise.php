<?php declare(strict_types = 1);

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
     *
     * @throws DataContainerException
     */
    #[Override]
    protected function containerise(mixed $value): BinaryStringValueContainer
    {
        /** @phpstan-var BinaryStringContaineriser */
        static $binaryStringContaineriser = new BinaryStringContaineriser();
        return $binaryStringContaineriser($value);
    }
}