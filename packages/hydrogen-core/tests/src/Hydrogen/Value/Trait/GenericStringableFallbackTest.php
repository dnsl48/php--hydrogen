<?php declare(strict_types=1);

namespace Tests\Hydrogen\Value\Trait;

use Hydrogen\Exception\HydrogenException;
use Hydrogen\Exception\LogicException;
use Hydrogen\Reflection\AttributeFinder;
use Hydrogen\Value;
use Hydrogen\Value\AbstractValue;
use Hydrogen\Value\Trait\GenericStringableFallback;
use Override;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\UsesClass;
use PHPUnit\Framework\TestCase;
use Tests\Fixture\Value\NaiveValueObject\NaiveValueContracts;

#[CoversClass(GenericStringableFallback::class)]
#[UsesClass(AbstractValue::class)]
#[UsesClass(AttributeFinder::class)]
#[UsesClass(LogicException::class)]
#[UsesClass(HydrogenException::class)]
class GenericStringableFallbackTest extends TestCase
{
    private function mock(mixed $value): Value
    {
        return new class($value) extends AbstractValue
        {
            use GenericStringableFallback;
            use NaiveValueContracts;

            #[Override]
            public function jsonSerialize(): mixed
            {
                return $this->valueContainer->getValue();
            }
        };
    }

    private function badMock(mixed $value): Value
    {
        return new class($value) extends AbstractValue
        {
            use GenericStringableFallback;
            use NaiveValueContracts;

            #[Override]
            public function jsonSerialize(): mixed
            {
                $a = new \stdClass;
                $a->a = $a;

                return $a;
            }
        };
    }

    public function testFallback(): void
    {
        static::assertEquals('null', (string) $this->mock(null));
        static::assertEquals('"string"', (string) $this->mock("string"));
        static::assertEquals('-16', (string) $this->mock(-16));
    }

    public function testFailedJson(): void
    {
        $this->expectException(LogicException::class);
        static::assertEquals('toast', $this->badMock(null));
    }
}
