<?php

declare(strict_types=1);

namespace Hydrogen\Tests\Hydrogen\Struct\Hydration\DataSource;

use Hydrogen\Exception\DataHydrationException;
use Hydrogen\Exception\DataIntegrityException;
use Hydrogen\Exception\HydrogenException;
use Hydrogen\Hydration\DataSource\PlainDataSource;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\UsesClass;
use PHPUnit\Framework\ExpectationFailedException;
use PHPUnit\Framework\TestCase;
use ReflectionProperty;
use stdClass;
use Hydrogen\Tests\Fixture\DataSources\MockDataSourceA;
use Hydrogen\Tests\Fixture\DataSources\MockDataSourceB;
use Hydrogen\Tests\Fixture\Native\Struct\NativeStructA;
use Hydrogen\Tests\Fixture\Native\Struct\NativeStructAB;
use Hydrogen\Tests\Fixture\Native\Struct\NativeStructB;

#[CoversClass(PlainDataSource::class)]
#[UsesClass(DataHydrationException::class)]
#[UsesClass(DataIntegrityException::class)]
#[UsesClass(HydrogenException::class)]
class PlainDataSourceTest extends TestCase
{
    public function testConstructor(): void
    {
        $sourceA = new PlainDataSource([]);

        static::assertFalse($sourceA->containsInstanceOf(stdClass::class));
    }

    // public function testToDebugStringA(): void
    // {
    //     $source = new PlainDataSource();

    //     static::assertEquals('Hydrogen\Struct\Hydration\DataSource\PlainDataSource[]', $source->toDebugString());
    // }

    // public function testToDebugStringB(): void
    // {
    //     $sourceB = new PlainDataSource(
    //         [
    //             'key 0' => ['a', 'b', 'c'],
    //             'key 1' => 'value 1'
    //         ],
    //         new class extends stdClass {
    //             public string $key_2 = 'value 2';
    //             public string $key_3 = 'value 3';
    //         },
    //         new MockDataSourceA(
    //             [
    //                 'key 4' => 'value 4',
    //                 'key 5' => 'value 5'
    //             ],
    //             new PoPoA(boolean: true),
    //             new MockDataSourceB(
    //                 new PoPoAB(nullableInteger: 6, nullableBoolean: true),
    //                 [
    //                     'key 6' => 'value A',
    //                     'key 7' => 'value B'
    //                 ],
    //             )
    //         )
    //     );

    //     static::assertEquals(
    //         "Hydrogen\Struct\Hydration\DataSource\PlainDataSource[['key 0' => array, \n'key 1' => string], ".
    //         "stdClass@anonymous, ".
    //         "Hydrogen\Tests\Struct\Hydration\DataSource\Mock\MockDataSourceA]",
    //         $sourceB->toDebugString()
    //     );
    // }

    // public function testToDebugStringC(): void
    // {
    //     $sourceA = new PlainDataSource(['list' => ['a', 'b', 'c']], new stdClass);

    //     static::assertEquals(
    //         "Hydrogen\Struct\Hydration\DataSource\PlainDataSource[['list' => array], stdClass]",
    //         $sourceA->toDebugString()
    //     );
    // }

    public function getSource(): PlainDataSource
    {
        return new PlainDataSource(
            [
                'key 0' => ['a', 'b', 'c'],
                'key 1' => 'value 1'
            ],
            new MockDataSourceA(
                [
                    'key 4' => 'value 4',
                    'key 5' => 'value 5'
                ],
                new MockDataSourceB(
                    new NativeStructA(boolean: true),
                    [
                        'key 6' => 'value A',
                        'key 7' => 'value B'
                    ],
                ),
                new NativeStructAB(nullableBoolean: true, nullableInteger: 6),
            ),
            new class () extends stdClass {
                public string $key_2 = 'value 2';
                public string $key_3 = 'value 3';
            }
        );
    }

    public function testContainsInstanceOf(): void
    {
        $source = $this->getSource();

        static::assertTrue($source->containsInstanceOf(stdClass::class));
        static::assertTrue($source->containsInstanceOf(MockDataSourceB::class));
    }

    /**
     * @throws DataHydrationException
     * @throws ExpectationFailedException
     */
    public function testPropertyValueA(): void
    {
        $source = $this->getSource();

        static::assertFalse($source->containsInstanceOf(NativeStructB::class));

        $this->expectException(DataHydrationException::class);
        $this->expectExceptionMessage(sprintf('Could not find an instance of %s', NativeStructB::class));

        $source->fetchPropertyValue(new ReflectionProperty(NativeStructB::class, 'integer'));
    }

    /**
     * @throws DataHydrationException
     * @throws ExpectationFailedException
     */
    public function testPropertyValueB(): void
    {
        $source = $this->getSource();

        static::assertTrue($source->containsInstanceOf(NativeStructA::class));
        static::assertTrue($source->fetchPropertyValue(new ReflectionProperty(NativeStructA::class, 'boolean')));
    }

    /**
     * @throws ExpectationFailedException
     * @throws DataHydrationException
     */
    public function testPropertyValueC(): void
    {
        $source = $this->getSource();

        static::assertTrue($source->containsInstanceOf(NativeStructAB::class));
        static::assertEquals(
            6,
            $source->fetchPropertyValue(new ReflectionProperty(NativeStructAB::class, 'nullableInteger'))
        );
    }

    /**
     * @throws ExpectationFailedException
     * @throws DataHydrationException
     */
    public function testPropertyValueD(): void
    {
        $source = $this->getSource();

        static::assertTrue($source->containsInstanceOf(NativeStructAB::class));
        static::assertEquals(
            6,
            $source->fetchPropertyValue(new ReflectionProperty(NativeStructAB::class, 'nullableInteger'))
        );
    }

    /**
     * @return void
     * @throws ExpectationFailedException
     */
    public function testHasValueForName(): void
    {
        $source = $this->getSource();

        /* Existing array key */
        static::assertTrue($source->hasValueForName('key 0'));

        /* Failing key */
        static::assertFalse($source->hasValueForName('key 00'));

        /* Existing object key */
        static::assertTrue($source->hasValueForName('key_2'));

        /* Existing key within an object */
        static::assertTrue($source->hasValueForName('key 4'));
    }

    /**
     * @return void
     * @throws DataHydrationException
     * @throws ExpectationFailedException
     */
    public function testFetchValueForName(): void
    {
        $source = $this->getSource();

        static::assertEquals('value 1', $source->fetchValueForName('key 1'));

        static::assertEquals('value 4', $source->fetchValueForName('key 4'));

        static::assertEquals('value 3', $source->fetchValueForName('key_3'));

        /* Non-existing key */
        $this->expectException(DataHydrationException::class);
        $this->expectExceptionMessage('Could not find the property named "key 3"');

        static::assertEquals('value 3', $source->fetchValueForName('key 3'));
    }
}
