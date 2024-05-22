<?php declare(strict_types = 1);

namespace Tests\Hydrogen\Exception;

use Exception;
use Hydrogen\Exception\DataIntegrityException;
use Hydrogen\Exception\DataSanitisationException;
use Hydrogen\Exception\HydrogenException;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\ExpectationFailedException;
use PHPUnit\Framework\TestCase;
use Random\RandomException;

#[CoversClass(DataSanitisationException::class)]
#[CoversClass(DataIntegrityException::class)]
#[CoversClass(HydrogenException::class)]
final class DataSanitisationExceptionTest extends TestCase
{
    /**
     * @throws RandomException
     * @throws ExpectationFailedException 
     */
    public function testConstruct(): void
    {
        $value = random_bytes(8);
        $message = random_bytes(8);
        $previous = new Exception(random_bytes(4));

        $exception = new DataSanitisationException($value, $message, $previous);

        self::assertEquals($value, $exception->getBadValue());
        self::assertEquals($message, $exception->getMessage());
        self::assertEquals($previous, $exception->getPrevious());
    }
}