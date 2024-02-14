<?php declare(strict_types = 1);

namespace Hydrogen\Tests\Unit\Exception;

use Exception;
use Hydrogen\Exception\DataSanitisationException;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\UsesClass;
use PHPUnit\Framework\TestCase;

#[CoversClass(DataSanitisationException::class)]
#[UsesClass(Exception::class)]
final class DataSanitisationExceptionTest extends TestCase
{
    public function testConstruct(): void
    {
        $value = random_bytes(8);
        $message = random_bytes(8);
        $previous = new Exception(random_bytes(4));

        $exception = new DataSanitisationException($value, $message, $previous);

        $this->assertEquals($value, $exception->getBadValue());
        $this->assertEquals($message, $exception->getMessage());
        $this->assertEquals($previous, $exception->getPrevious());
    }
}