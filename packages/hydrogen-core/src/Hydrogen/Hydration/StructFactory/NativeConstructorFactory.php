<?php declare(strict_types = 1);

namespace Hydrogen\Hydration\StructFactory;

use Hydrogen\Attribute\Nullify;
use Hydrogen\Attribute\Nullify\Stage;
use Hydrogen\Attribute\PreTypecast;
use Hydrogen\Attribute\TypeHint;
use Hydrogen\Exception\DataHydrationException;
use Hydrogen\Exception\HydrogenException;
use Hydrogen\Exception\LogicException;
use Hydrogen\Hydration\DataFactory\GenericNativeDataFactoryProvider;
use Hydrogen\Hydration\DataSource;
use Hydrogen\Hydration\DatumFactory;
use Hydrogen\Reflection\AttributeFinder;
use Hydrogen\Value\Contract\Typecast\NativeTypesEnum;
use Hydrogen\Value\Contract\Typecast\ToNativeArray;
use Hydrogen\Value\Contract\Typecast\ToNativeBool;
use Hydrogen\Value\Contract\Typecast\ToNativeFloat;
use Hydrogen\Value\Contract\Typecast\ToNativeInt;
use Hydrogen\Value\Contract\Typecast\TypecastAwareConstructor;
use Override;
use ReflectionAttribute;
use ReflectionClass;
use ReflectionException;
use ReflectionIntersectionType;
use ReflectionNamedType;
use ReflectionUnionType;
use Stringable;

/**
 * Native Constructor Factory relying on the PHP native constructors.
 *
 * @phpstan-template T of object
 * @phpstan-implements DatumFactory<T>
 */
class NativeConstructorFactory implements DatumFactory
{
    /**
     * @throws LogicException If the target class does not have an appropriate constructor
     */
    public function __construct(
        /** @phpstan-var ReflectionClass<T> */
        private ReflectionClass $targetClass,
        private DataSource $dataSource
    )
    {
        if (!static::validateConstructor($targetClass)) {
            throw new LogicException(sprintf('Incompatible constructor \'%s\'', $targetClass->getName()));
        }
    }

    /**
     * @phpstan-param ReflectionClass<T> $targetClass
     */
    public static function validateConstructor(ReflectionClass $targetClass): bool
    {
        $constructor = $targetClass->getConstructor();

        if (null === $constructor) {
            return false;
        }

        return $constructor->isPublic() && !$constructor->isStatic() && !$constructor->isAbstract();
    }

    /**
     * @inheritdoc
     *
     * @phpstan-return T
     * @throws HydrogenException
     */
    #[Override]
    public function instantiate(): object {
        $arguments = [];
        $constructor = $this->targetClass->getConstructor();

        if (null === $constructor) {
            throw new LogicException(sprintf('%s does not have a constructor...', $this->targetClass->getName()));
        }

        try {
            foreach ($constructor->getParameters() as $parameter) {
                $position = $parameter->getPosition();
                $name = $parameter->getName();
                $optional = $parameter->isOptional() || $parameter->allowsNull();

                $nullable = $parameter->allowsNull();
                $hasDefault = $parameter->isDefaultValueAvailable();

                $hasType = $parameter->hasType();
                $nativeType = $parameter->getType();

                $parameter_pretypecasts = $parameter->getAttributes(PreTypecast::class, ReflectionAttribute::IS_INSTANCEOF);

                $parameter_nullifyers = array_map(
                    static function (ReflectionAttribute $attr): Nullify {
                        return $attr->newInstance();
                    },
                    $parameter->getAttributes(Nullify::class, ReflectionAttribute::IS_INSTANCEOF)
                );

                if ($this->dataSource->hasValueForName($name)) {
                    $arguments[$name] = $this->dataSource->fetchValueForName($name);
                } elseif ($this->dataSource->hasValueForName((string) $position)) {
                    $arguments[$name] = $this->dataSource->fetchValueForName((string) $position);
                } elseif ($hasDefault) {
                    $arguments[$name] = $parameter->getDefaultValue();
                } elseif ($nullable || $optional) {
                    $arguments[$name] = null;
                } else {
                    throw new DataHydrationException(
                        null,
                        sprintf(
                            'Parameter \'%s::__construct(..., (%d) $%s ,...)\' is mandatory, but the data source is missing a value',
                            $this->targetClass->getName(),
                            $position,
                            $name
                        )
                    );
                }

                $argument_value = $arguments[$name];

                foreach ($parameter_nullifyers as $nullifyer) {
                    if (($nullifyer->nullifyStage->value & Stage::PreTypecast->value) != 0) {
                        if ($nullifyer->typecast->is_null($argument_value)) {
                            $argument_value = null;
                        }
                    }
                }

                foreach ($parameter_pretypecasts as $pretypecast) {
                    $ptci = $pretypecast->newInstance();
                    assert($ptci instanceof PreTypecast);

                    $argument_value = call_user_func($ptci->transformer, $argument_value);
                }

                foreach ($parameter_nullifyers as $nullifyer) {
                    if (($nullifyer->nullifyStage->value & Stage::PreConstruct->value) != 0) {
                        if ($nullifyer->typecast->is_null($argument_value)) {
                            $argument_value = null;
                        }
                    }
                }

                if ($hasType) {
                    $types = [];
                    if ($nativeType instanceof ReflectionUnionType) {
                        $types = $nativeType->getTypes();
                    } elseif ($nativeType instanceof ReflectionNamedType) {
                        $types[] = $nativeType;
                    } elseif ($nativeType instanceof ReflectionIntersectionType) {
                        $types[] = $nativeType;
                    }

                    foreach ($types as $type) {
                        if ($type instanceof ReflectionNamedType) {
                            if ($type->isBuiltin()) {
                                switch (NativeTypesEnum::fromVar($type->getName())) {
                                    case NativeTypesEnum::ARRAY:
                                        if (is_array($argument_value)) {
                                            continue 3;
                                        }

                                        if ($argument_value instanceof ToNativeArray) {
                                            $arguments[$name] = $argument_value->toNativeArray();
                                            continue 3;
                                        }

                                        break;

                                    case NativeTypesEnum::BOOLEAN:
                                        if (is_bool($argument_value)) {
                                            continue 3;
                                        }

                                        if ($argument_value instanceof ToNativeBool) {
                                            $arguments[$name] = $argument_value->toNativeBool();
                                            continue 3;
                                        }

                                        break;

                                    case NativeTypesEnum::FLOAT:
                                        if (is_float($argument_value)) {
                                            continue 3;
                                        }

                                        if ($argument_value instanceof ToNativeFloat) {
                                            $arguments[$name] = $argument_value->toNativeFloat();
                                            continue 3;
                                        }

                                        break;

                                    case NativeTypesEnum::INTEGER:
                                        if (is_int($argument_value)) {
                                            continue 3;
                                        }

                                        if ($argument_value instanceof ToNativeInt) {
                                            $arguments[$name] = $argument_value->toNativeInt();
                                            continue 3;
                                        }

                                        break;

                                    case NativeTypesEnum::STRING:
                                        if (is_string($argument_value)) {
                                            continue 3;
                                        }

                                        if ($argument_value instanceof Stringable) {
                                            $arguments[$name] = (string) $argument_value;
                                            continue 3;
                                        }

                                        break;

                                    case NativeTypesEnum::NULL:
                                    case NativeTypesEnum::OBJECT:
                                    case NativeTypesEnum::RESOURCE:
                                    case NativeTypesEnum::CLOSED_RESOURCE:
                                        continue 2;
                                }
                            } else {
                                /** @phpstan-var class-string */
                                $type_name = $type->getName();
                                $type_reflection = new ReflectionClass($type_name);

                                $type_nullifyers = (new AttributeFinder($type_name, Nullify::class))->getAttributeInstances();

                                if (is_object($argument_value) && $type_reflection->isInstance($argument_value)) {

                                    if ($optional) {
                                        foreach ($type_nullifyers as $nullifyer) {
                                            if (($nullifyer->nullifyStage->value & Stage::PostConstruct->value) != 0) {
                                                if ($nullifyer->typecast->is_null($argument_value)) {
                                                    $argument_value = null;
                                                }
                                            }
                                        }
                                    }

                                    $arguments[$name] = $argument_value;
                                    continue 2;
                                } elseif ($optional) {
                                    foreach ($type_nullifyers as $nullifyer) {
                                        if (($nullifyer->nullifyStage->value & Stage::PreConstruct->value) != 0) {
                                            if ($nullifyer->typecast->is_null($argument_value)) {
                                                $argument_value = null;
                                            }
                                        }
                                    }
                                }

                                if ($optional && null === $argument_value) {
                                    $arguments[$name] = null;
                                    continue 2;
                                }

                                if ($type_reflection->implementsInterface(TypecastAwareConstructor::class)) {
                                    $argument_value = $type_reflection->newInstance($argument_value);

                                    foreach ($parameter_nullifyers as $nullifyer) {
                                        if (($nullifyer->nullifyStage->value & Stage::PostConstruct->value) != 0) {
                                            if ($nullifyer->typecast->is_null($argument_value)) {
                                                $argument_value = null;
                                            }
                                        }
                                    }

                                    $arguments[$name] = $argument_value;

                                    continue 2;
                                }
                            }
                        }
                    }
                }
            }

            /** @phpstan-var T $result */
            $result = $this->targetClass->newInstance(...$arguments);

            assert(is_a($result, $this->targetClass->getName()));

            return $result;
        } catch (ReflectionException $e) {
            throw new HydrogenException(sprintf('Could not construct %s', $this->targetClass->getName()), $e);
        }
    }
}
