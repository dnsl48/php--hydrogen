<?php declare(strict_types = 1);

namespace Hydrogen\Tests\Value\Sanitiser;

use Hydrogen\Exception\DataIntegrityException;
use Hydrogen\Exception\DataSanitisationException;
use Hydrogen\Exception\HydrogenException;
use Hydrogen\Value\Sanitiser\AbstractSanitiser;
use Hydrogen\Value\Sanitiser\StringSanitiser;
use Override;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\UsesClass;
use PHPUnit\Framework\ExpectationFailedException;
use PHPUnit\Framework\TestCase;
use Stringable;

#[CoversClass(StringSanitiser::class)]
#[CoversClass(AbstractSanitiser::class)]
#[UsesClass(DataSanitisationException::class)]
#[UsesClass(DataIntegrityException::class)]
#[UsesClass(HydrogenException::class)]
class StringSanitiserTest extends TestCase
{
    /**
     * @throws DataSanitisationException 
     * @throws ExpectationFailedException 
     */
    public function testSanitiseString(): void
    {
        static::assertEquals("", StringSanitiser::sanitiseValue(null));

        static::assertEquals("1", (new StringSanitiser(true))->sanitise());
        static::assertEquals("", StringSanitiser::sanitiseValue(false));

        static::assertEquals("-842", StringSanitiser::sanitiseValue(-842));
        static::assertEquals("-1", StringSanitiser::sanitiseValue(-1));
        static::assertEquals("0", StringSanitiser::sanitiseValue(0));
        static::assertEquals("1", StringSanitiser::sanitiseValue(1));
        static::assertEquals("2", StringSanitiser::sanitiseValue(2));

        static::assertEquals("NAN", StringSanitiser::sanitiseValue(NAN));
        static::assertEquals("-INF", StringSanitiser::sanitiseValue(-INF));
        static::assertEquals("-4.56", StringSanitiser::sanitiseValue(-4.56));
        static::assertEquals("0", StringSanitiser::sanitiseValue(0.0));
        static::assertEquals("0.42", StringSanitiser::sanitiseValue(0.42));
        static::assertEquals("INF", StringSanitiser::sanitiseValue(INF));

        static::assertEquals("A B C d e f", StringSanitiser::sanitiseValue("A B C d e f"));

        static::assertEquals('I am the test object', StringSanitiser::sanitiseValue(new class implements Stringable {
            #[Override]
            public function __toString(): string
            {
                return 'I am the test object';
            }
        }));

        $this->expectException(DataSanitisationException::class);
        $this->expectExceptionMessage('Cannot cast a non-scalar non-stringable value to string');

        static::assertEquals('I am the test object', StringSanitiser::sanitiseValue(new \stdClass()));
    }
}