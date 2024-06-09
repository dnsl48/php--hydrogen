<?php

declare(strict_types=1);

namespace Hydrogen\Factory\Native;

use Hydrogen\Exception\LogicException;
use Hydrogen\Exception\HydrogenException;
use Hydrogen\Hydration\DataSource\PlainDataSource;
use Hydrogen\Hydration\StructFactory\NativeConstructorFactoryProvider;
use ReflectionClass;
use ReflectionException;

class StructFactory
{
    /**
     * @phpstan-template T of object
     *
     * @phpstan-param class-string<T> $classname
     * @phpstan-param (object|iterable<mixed, mixed>)[] $dataSource
     *
     * @phpstan-return T
     *
     * @throws LogicException
     * @throws HydrogenException
     * @throws ReflectionException
     */
    public static function make(string $classname, object|iterable ...$dataSource): object
    {
        /** @throws ReflectionException */
        $ref = new ReflectionClass($classname);

        $factory_provider = new NativeConstructorFactoryProvider($ref);

        $factory = $factory_provider(new PlainDataSource(...$dataSource));

        return $factory->instantiate();
    }
}
