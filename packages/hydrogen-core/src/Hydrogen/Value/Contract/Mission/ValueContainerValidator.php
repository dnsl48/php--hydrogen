<?php

declare(strict_types=1);

namespace Hydrogen\Value\Contract\Mission;

use Hydrogen\Exception\DataValidationException;
use Hydrogen\Value\Contract\Container\SanitisedValueContainer;
use Hydrogen\Value\Contract\Container\ValidatedValueContainer;

/**
 * @phpstan-template TSanitised
 * @phpstan-template TValidated
 *
 * @api
 */
interface ValueContainerValidator
{
    /**
     * @phpstan-param SanitisedValueContainer<TSanitised> $valueContainer
     *
     * @phpstan-return ValidatedValueContainer<TValidated>
     *
     * @phpstan-throws DataValidationException<TSanitised>
     * @throws DataValidationException
     */
    public function __invoke(SanitisedValueContainer $valueContainer): ValidatedValueContainer;
}
