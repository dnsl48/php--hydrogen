<?php

declare(strict_types=1);

namespace Hydrogen\Struct\Trait;

use Hydrogen\Exception\HydrogenException;
use Hydrogen\Exception\LogicException;
use Hydrogen\Struct;
use Hydrogen\Hydration\DataSource;
use Hydrogen\Hydration\DataSource\PlainDataSource;
use Hydrogen\Hydration\StructFactory\NativeConstructorFactory;
use Override;
use ReflectionClass;

/**
 * @phpstan-require-implements Struct
 */
trait GenericStructImplementation
{
    /**
     * @throws LogicException
     * @throws HydrogenException
     */
    #[Override]
    public static function construct(object|iterable ...$sources): static
    {
        $dataSources = [];

        foreach ($sources as $source) {
            if ($source instanceof DataSource) {
                $dataSources[] = $source;
            } elseif (is_object($source)) {
                $dataSources[] = new PlainDataSource($source);
            } else {
                $dataSources[] = new PlainDataSource(iterator_to_array($source));
            }
        }

        $dataSource = new PlainDataSource(...$dataSources);

        $self = new ReflectionClass(static::class);

        $factory = new NativeConstructorFactory($self, $dataSource);

        return $factory->instantiate();
    }

    // public static function getStructFactory() {

    // }
}
