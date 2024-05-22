<?php declare(strict_types = 1);

namespace Hydrogen\Reflection;

use ReflectionAttribute;
use ReflectionClass;

/**
 * @phpstan-template TSource of object
 * @phpstan-template TAttribute of object
 */
class AttributeFinder
{
    public function __construct(
        /** @phpstan-var class-string<TSource> */
        public readonly string $classname,

        /** @phpstan-var class-string<TAttribute> */
        public readonly string $attribute
    )
    {
    }

    /**
     * @phpstan-return \Generator<ReflectionAttribute<TAttribute>>
     */
    public function getAttributeReflections(): iterable
    {
        $ref = new ReflectionClass($this->classname);

        do {
            foreach ($ref->getAttributes($this->attribute, ReflectionAttribute::IS_INSTANCEOF) as $attribute) {

                yield $attribute;
            }
        } while ($ref = $ref->getParentClass());
    }

    /**
     * @phpstan-return \Generator<TAttribute>
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