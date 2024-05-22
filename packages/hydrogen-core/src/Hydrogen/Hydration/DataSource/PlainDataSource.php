<?php
declare(strict_types = 1);

namespace Hydrogen\Hydration\DataSource;

use Hydrogen\Exception\DataHydrationException;
use Hydrogen\Exception\HydrogenException;
use Hydrogen\Hydration\DataSource;
use Override;
use ReflectionException;
use ReflectionProperty;

/**
 * Contains one or more of data objects.
 * Returns the first occurrence of a value from the list.
 */
class PlainDataSource implements DataSource
{
    /**
     * List of the data sources
     *
     * @var mixed[]
     */
    private array $sources = [];

    public function __construct(mixed ...$sources)
    {
        $this->sources = $sources;
    }

    // #[Override]
    // public function toDebugString(): string
    // {
    //     $result = [];
    //     foreach ($this->sources as $source) {
    //         if (is_array($source)) {
    //             $pairs = [];
    //             foreach ($source as $k=>$v) {
    //                 $pairs[] = '\'' . addcslashes((string) $k, '\'') . '\'' . ' => ' . get_debug_type($v);
    //             }
    //             $result[] = '[' . implode(', ' . PHP_EOL, $pairs) . ']';
    //         } else {
    //             $result[] = get_debug_type($source);
    //         }
    //     }

    //     return sprintf(
    //         '%s[%s]',
    //         get_debug_type($this),
    //         implode(', ', $result)
    //     );
    // }

    #[Override]
    public function containsInstanceOf(string $fqcn): bool
    {
        foreach ($this->sources as $source) {
            if (is_object($source) && is_a($source, $fqcn, false)) {
                return true;
            } else if (($source instanceof DataSource) && $source->containsInstanceOf($fqcn)) {
                return true;
            }
        }

        return false;
    }

    /**
     * @phpstan-throws DataHydrationException<array{DataSource, ReflectionProperty}>
     * @throws DataHydrationException
     */
    #[Override]
    public function fetchPropertyValue(ReflectionProperty $property): mixed
    {
        $fqcn = $property->getDeclaringClass()->getName();

        foreach ($this->sources as $source) {
            if (is_object($source) && is_a($source, $fqcn, false)) {
                return $property->getValue($source);
            } else if ($source instanceof DataSource) {
                if ($source->containsInstanceOf($fqcn)) {
                    return $source->fetchPropertyValue($property);
                }
            }
        }

        // This is a logical error in the code. Use containsInstanceOf before trying to fetch a value.
        throw new DataHydrationException([$this, $property], sprintf('Could not find an instance of %s', $fqcn));
    }

    #[Override]
    public function hasValueForName(string $name): bool
    {
        foreach ($this->sources as $source) {
            if (is_array($source) && array_key_exists($name, $source)) {
                if (null !== $source[$name]) {
                    return true;
                }
            } elseif (($source instanceof DataSource) && $source->hasValueForName($name)) {
                return true;
            } elseif (is_object($source) && property_exists($source, $name)) {
                if (null !== $source->{$name}) { // @phpstan-ignore-line
                    return true;
                }
            }
        }

        return false;
    }

    /**
     * @phpstan-throws DataHydrationException<array{DataSource, string}>
     * @throws DataHydrationException
     */
    #[Override]
    public function fetchValueForName(string $name): mixed
    {
        foreach ($this->sources as $source) {
            if (is_array($source) && array_key_exists($name, $source)) {
                if (null !== $source[$name]) {
                    return $source[$name];
                }
            } elseif (($source instanceof DataSource) && $source->hasValueForName($name)) {
                return $source->fetchValueForName($name);
            } elseif (is_object($source) && property_exists($source, $name)) {
                if (null !== $source->{$name}) { // @phpstan-ignore-line
                    return $source->{$name}; // @phpstan-ignore-line
                }
            }
        }

        // This is a logical error in your code. Use hasValueForName before trying to fetch a value.
        throw new DataHydrationException([$this, $name], sprintf('Could not find the property named "%s"', $name));
    }
}
