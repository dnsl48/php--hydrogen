<?php

declare(strict_types=1);

namespace Hydrogen\Tests\Hydrogen\Exception;

use Exception;
use Hydrogen\Exception\DataIntegrityException;
use Hydrogen\Exception\DataValidationException;
use Hydrogen\Exception\HydrogenException;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\ExpectationFailedException;
use PHPUnit\Framework\TestCase;
use Random\RandomException;

#[CoversClass(DataValidationException::class)]
#[CoversClass(DataIntegrityException::class)]
#[CoversClass(HydrogenException::class)]
final class DataValidationExceptionTest extends TestCase
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

        $exception = new DataValidationException($value, $message, $previous);

        self::assertEquals($value, $exception->getBadValue());
        self::assertEquals($message, $exception->getMessage());
        self::assertEquals($previous, $exception->getPrevious());
    }
}
