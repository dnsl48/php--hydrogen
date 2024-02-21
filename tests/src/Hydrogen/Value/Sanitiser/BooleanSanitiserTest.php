<?php declare(strict_types = 1);

namespace Hydrogen\Tests\Value\Sanitiser;

use Hydrogen\Exception\DataIntegrityException;
use Hydrogen\Exception\DataSanitisationException;
use Hydrogen\Exception\HydrogenException;
use Hydrogen\Value\Sanitiser\AbstractSanitiser;
use Hydrogen\Value\Sanitiser\BooleanSanitiser;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\UsesClass;
use PHPUnit\Framework\ExpectationFailedException;
use PHPUnit\Framework\TestCase;
use stdClass;

#[CoversClass(BooleanSanitiser::class)]
#[CoversClass(AbstractSanitiser::class)]
#[UsesClass(DataSanitisationException::class)]
#[UsesClass(DataIntegrityException::class)]
#[UsesClass(HydrogenException::class)]
class BooleanSanitiserTest extends TestCase
{
    /**
     * @throws DataSanitisationException
     * @throws ExpectationFailedException
     */
    public function testSanitiseBoolean(): void
    {
        static::assertTrue((new BooleanSanitiser(true))->sanitise());
        static::assertFalse(BooleanSanitiser::sanitiseValue(false));

        static::assertTrue(BooleanSanitiser::sanitiseValue(1));
        static::assertFalse(BooleanSanitiser::sanitiseValue(0));

        static::assertFalse(BooleanSanitiser::sanitiseValue(null));

        static::assertFalse(BooleanSanitiser::sanitiseValue(''));
        static::assertFalse(BooleanSanitiser::sanitiseValue('0'));
        static::assertTrue(BooleanSanitiser::sanitiseValue('1'));

        $this->expectException(DataSanitisationException::class);
        $this->expectExceptionMessage('Could not read the boolean value. Only bool, null, "", 1 or 0 are accepted.');

        BooleanSanitiser::sanitiseValue('controversial');
    }
}