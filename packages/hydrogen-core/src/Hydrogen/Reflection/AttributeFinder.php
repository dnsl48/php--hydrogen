<?php

declare(strict_types=1);

namespace Hydrogen\Reflection;

use Generator;
use ReflectionAttribute;
use ReflectionClass;
use ReflectionException;

/**
 * @phpstan-template TSource of object
 * @phpstan-template TAttribute of object
 */
readonly class AttributeFinder
{
    public function __construct(
        /** @phpstan-var class-string<TSource> $classname */
        public string $classname,
        /** @phpstan-var class-string<TAttribute> $attribute */
        public string $attribute
    ) {
    }

    /**
     * @phpstan-return Generator<ReflectionAttribute<TAttribute>>
     */
    public function getAttributeReflections(): iterable
    {
        try {
            $ref = new ReflectionClass($this->classname);
        } catch (ReflectionException) {  // @phpstan-ignore-line
            return [];
        }

        do {
            foreach ($ref->getAttributes($this->attribute, ReflectionAttribute::IS_INSTANCEOF) as $attribute) {
                yield $attribute;
            }
        } while ($ref = $ref->getParentClass());
    }

    /**
     * @phpstan-return Generator<TAttribute>
     */
    public function getAttributeInstances(): iterable
    {
        foreach ($this->getAttributeReflections() as $ref) {
            yield $ref->newInstance();
        }
    }

    // /**
    //  * @phpstan-return TAttribute[]
    //  */
    // public function _getAttributeInstances(): array
    // {
    //     $ref = new ReflectionClass($this->classname);
    //     $hierarchy = [$ref];

    //     while ($ref = $ref->getParentClass()) {
    //         $hierarchy[] = $ref;
    //     }

    //     $attribute = $this->attribute;

    //     /** @phpstan-var TAttribute[] */
    //     $value = array_reduce(
    //         $hierarchy,
    //         static function ($carry, ReflectionClass $ref) use ($attribute) {
    //             $attributes = array_map(
    //                 static function (ReflectionAttribute $attribute) {
    //                     return $attribute->newInstance();
    //                 },
    //                 $ref->getAttributes($attribute, ReflectionAttribute::IS_INSTANCEOF)
    //             );

    //             return array_merge($carry, $attributes);
    //         },
    //         []
    //     );

    //     return $value;
    // }
}
