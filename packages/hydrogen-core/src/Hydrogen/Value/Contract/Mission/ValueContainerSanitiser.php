<?php declare(strict_types = 1);

namespace Hydrogen\Value\Contract\Mission;

use Hydrogen\Exception\DataSanitisationException;
use Hydrogen\Value\Contract\Container\SanitisedValueContainer;
use Hydrogen\Value\Contract\Container\TypecastedValueContainer;

/**
 * @phpstan-template TCasted
 * @phpstan-template TSanitised
 * 
 * @api
 */
interface ValueContainerSanitiser
{
    /**
     * @phpstan-param TypecastedValueContainer<TCasted> $valueContainer
     *
     * @phpstan-return SanitisedValueContainer<TSanitised>
     *
     * @phpstan-throws DataSanitisationException<TCasted>
     * @throws DataSanitisationException
     */
    public function __invoke(TypecastedValueContainer $valueContainer): SanitisedValueContainer;
}