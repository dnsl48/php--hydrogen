<?php declare(strict_types = 1);

namespace Tests\Hydrogen\Value;

use Hydrogen\Reflection\AttributeFinder;
use Hydrogen\Value;
use Hydrogen\Value\AbstractValue;
use Hydrogen\Value\Trait\GenericJsonSerializeFallback;
use Hydrogen\Value\Trait\GenericStringableFallback;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\UsesClass;
use PHPUnit\Framework\TestCase;
use Tests\Fixture\Value\NaiveValueObject\NaiveValueContracts;

#[CoversClass(AbstractValue::class)]
#[UsesClass(AttributeFinder::class)]
#[UsesClass(GenericJsonSerializeFallback::class)]
#[UsesClass(GenericStringableFallback::class)]
class AbstractValueTest extends TestCase
{
    private function mock(mixed $value): Value
    {
        return new class ($value) extends AbstractValue {
            use GenericJsonSerializeFallback;
            use GenericStringableFallback;
            use NaiveValueContracts;
        };
    }

    public function testConstructor(): void
    {
        static::assertNull($this->mock(null)->jsonSerialize());
    }
}