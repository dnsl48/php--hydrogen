<?php

declare(strict_types=1);

namespace Hydrogen\Tests\Fixture\Value;

use Hydrogen\Value\AbstractValue;
use Hydrogen\Value\Trait\GenericJsonSerializeFallback;
use Hydrogen\Value\Trait\GenericStringableFallback;
use Hydrogen\Tests\Fixture\Value\NaiveValueObject\NaiveValueContracts;

/**
 * @phpstan-extends AbstractValue<mixed, mixed, mixed, mixed, mixed>
 */
class NaiveValueObject extends AbstractValue
{
    use GenericJsonSerializeFallback;
    use GenericStringableFallback;
    use NaiveValueContracts;
}
