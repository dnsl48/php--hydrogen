<?php declare(strict_types=1);

namespace Tests\Hydrogen\Value\Trait;

use Hydrogen\Exception\HydrogenException;
use Hydrogen\Exception\LogicException;
use Hydrogen\Reflection\AttributeFinder;
use Hydrogen\Value\AbstractValue;

use Hydrogen\Value\Trait\GenericJsonSerializeFallback;
use JsonSerializable;
use Override;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\UsesClass;
use PHPUnit\Framework\ExpectationFailedException;
use PHPUnit\Framework\TestCase;
use Stringable;
use Tests\Fixture\Value\NaiveValueObject\NaiveValueContracts;

enum _EnumClean
{
    case A;
    case B;
}

enum _EnumBackedStr: string
{
    case A = 'A';
    case B = 'B';
}

enum _EnumBackedInt: int
{
    case A = 0;
    case B = 1;
}

#[CoversClass(GenericJsonSerializeFallback::class)]
#[UsesClass(AbstractValue::class)]
#[UsesClass(AttributeFinder::class)]
#[UsesClass(HydrogenException::class)]
#[UsesClass(LogicException::class)]
class GenericJsonSerializeFallbackTest extends TestCase
{
    /**
     * @throws LogicException 
     */
    private function mock(mixed $value): mixed
    {
        return (new class($value) extends AbstractValue
        {
            use GenericJsonSerializeFallback;
            use NaiveValueContracts;

            #[Override]
            public function __toString(): string
            {
                return '';
            }
        })->jsonSerialize();
    }

    /**
     * @throws LogicException 
     * @throws ExpectationFailedException 
     */
    public function testFallback(): void
    {
        static::assertNull($this->mock(null));

        static::assertTrue($this->mock(true));
        static::assertFalse($this->mock(false));

        static::assertEquals('', $this->mock(""));
        static::assertEquals('string', $this->mock("string"));

        static::assertEquals(-1, $this->mock(-1));
        static::assertEquals(0, $this->mock(0));
        static::assertEquals(1, $this->mock(1));

        static::assertNan($this->mock(NAN));
        static::assertEquals(-INF, $this->mock(-INF));
        static::assertEquals(-1.2, $this->mock(-1.2));
        static::assertEquals(0.0, $this->mock(0.0));
        static::assertEquals(1.2, $this->mock(1.2));
        static::assertEquals(INF, $this->mock(INF));

        static::assertEquals(['a' => 'b'], $this->mock(new class() implements JsonSerializable
        {
            #[Override]
            public function jsonSerialize(): mixed
            {
                return ['a' => 'b'];
            }
        }));

        static::assertEquals('toast', $this->mock(new class() implements Stringable
        {
            #[Override]
            public function __toString(): string
            {
                return 'toast';
            }
        }));

        static::assertEquals('A', $this->mock(_EnumBackedStr::A));
        static::assertEquals(1, $this->mock(_EnumBackedInt::B));

        $this->expectException(LogicException::class);
        $this->expectExceptionMessage('Unserializable type: Tests\Hydrogen\Value\Trait\_EnumClean');
        static::assertEquals('A', $this->mock(_EnumClean::A));
    }

    public function testFailedSerialization(): void
    {
        try {
            $a = new \stdClass;
            $a->a = $a;
            $this->mock($a);
        } catch (LogicException $e) {
            static::assertEquals('Unserializable type: stdClass', $e->getMessage());
        }
    }
}
