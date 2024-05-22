<?php declare(strict_types = 1);

namespace Hydrogen\Struct\Trait;

use Hydrogen\Struct;
use Hydrogen\Hydration\DataSource;
use Hydrogen\Hydration\DataSource\PlainDataSource;
use Hydrogen\Hydration\DataFactory\DefaultFactoryProvider;
use Hydrogen\Hydration\StructFactory\NativeConstructorFactory;
use Hydrogen\Hydration\StructFactory\NativeConstructorFactoryProvider;
use Override;
use ReflectionClass;

/**
 * @phpstan-require-implements Struct
 */
trait GenericStructImplementation
{
    #[Override]
    public static function construct(object|iterable ...$sources): static
    {
        $dataSources = [];

        foreach ($sources as $source) {
            if ($source instanceof DataSource) {
                $dataSources[] = $source;
            } else if (is_object($source)) {
                $dataSources[] = new PlainDataSource($source);
            } else {
                $dataSources[] = new PlainDataSource(iterator_to_array($source, true));
            }
        }

        $dataSource = new PlainDataSource(...$dataSources);

        // $factory = DefaultFactoryProvider::getFactoryFor();

        $self = new ReflectionClass(static::class);

        $factory = new NativeConstructorFactory($self, $dataSource);

        return $factory->instantiate();

        // if (NativeConstructorFactory::validateConstructor($self)) {
            
        // }

        // return $factory->instantiate($dataSource);
    }

    // public static function getStructFactory() {
        
    // }
}
