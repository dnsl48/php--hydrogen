<?php

declare(strict_types=1);

namespace Hydrogen\Hydration\StructFactory;

use Hydrogen\Exception\LogicException;
use Hydrogen\Hydration\DataSource;
use Hydrogen\Hydration\DatumFactory\DatumFactoryProvider;
use Override;
use ReflectionClass;

/**
 * @phpstan-template T of object
 * @phpstan-extends DatumFactoryProvider<T>
 */
class NativeConstructorFactoryProvider extends DatumFactoryProvider
{
    /**
     * @throws LogicException If the target class does not have an appropriate constructor
     */
    public function __construct(
        /** @phpstan-var ReflectionClass<T> */
        private readonly ReflectionClass $targetClass
    ) {
        if (!static::validateConstructor($targetClass)) {
            throw new LogicException(sprintf('Incompatible constructor \'%s\'', $targetClass->getName()));
        }
    }

    /**
     * @phpstan-return NativeConstructorFactory<T>
     *
     * @throws LogicException If the target class does not have an appropriate constructor
     */
    #[Override]
    public function __invoke(DataSource $dataSource): NativeConstructorFactory
    {
        return new NativeConstructorFactory($this->targetClass, $dataSource);
    }

    /**
     * @phpstan-param ReflectionClass<T> $targetClass
     */
    public static function validateConstructor(ReflectionClass $targetClass): bool
    {
        return NativeConstructorFactory::validateConstructor($targetClass);
    }
}
