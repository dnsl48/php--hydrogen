<?php declare(strict_types = 1);

namespace Hydrogen\Value;

use Hydrogen\Attribute\PreSanitise;
use Hydrogen\Attribute\PreTypecast;
use Hydrogen\Contract\Patch;
use Hydrogen\Contract\Transformer;
use Hydrogen\Exception\DataContainerException;
use Hydrogen\Exception\DataSanitisationException;
use Hydrogen\Exception\DataTypecastException;
use Hydrogen\Exception\DataValidationException;
use Hydrogen\Reflection\AttributeFinder;
use Hydrogen\Value;
use Hydrogen\Value\Contract\Container\SanitisedValueContainer;
use Hydrogen\Value\Contract\Container\TypecastedValueContainer;
use Hydrogen\Value\Contract\Container\ValidatedValueContainer;
use Hydrogen\Value\Contract\Container\ValueContainer;
use Hydrogen\Value\Contract\Typecast\TypecastAwareConstructor;
use Override;

/**
 * @phpstan-template TInputValue     External type expected by the constructor
 * @phpstan-template TPreCastedInputValue     External type expected by the constructor
 * @phpstan-template TCastedValue    Internal type produced by the typecast method
 * @phpstan-template TSanitizedValue Internal type produced by the sanitise method
 * @phpstan-template TValidatedValue Internal type produced by the validation method
 *
 * @phpstan-implements ValueContainer<TValidatedValue>
 *
 * @api
 */
abstract class AbstractValue implements Value, TypecastAwareConstructor, ValueContainer
{
    /** @phpstan-var ValidatedValueContainer<TValidatedValue> */
    protected readonly ValidatedValueContainer $valueContainer;

    /**
     * @phpstan-param TInputValue $inputValue
     *
     * @phpstan-throws DataContainerException<TInputValue>
     * @phpstan-throws DataTypecastException<TInputValue>
     * @phpstan-throws DataSanitisationException<TCastedValue>
     * @phpstan-throws DataValidationException<TSanitizedValue>
     *
     * @throws DataContainerException
     * @throws DataTypecastException
     * @throws DataSanitisationException
     * @throws DataValidationException
     */
    #[Override]
    public function __construct(mixed $inputValue)
    {
        $this->valueContainer = $this->validate(
            $this->sanitise(
                $this->preSanitise(
                    $this->typecast(
                        $this->preTypecast(
                            $this->containerise($inputValue)
                        )
                    )
                )
            )
        );
    }

    /**
     * @phpstan-return TValidatedValue
     */
    #[Override]
    public function getValue(): mixed
    {
        return $this->valueContainer->getValue();
    }

    /**
     * @throws DataContainerException
     * @throws DataSanitisationException
     * @throws DataTypecastException
     * @throws DataValidationException
     */
    #[Override]
    public function transform(Transformer $transformer): ValueContainer
    {
        return new static($this->valueContainer->transform($transformer));
    }

    /**
     * @phpstan-param TInputValue $value
     *
     * @phpstan-return ValueContainer<TInputValue>
     *
     * @phpstan-throws DataContainerException<TInputValue>
     *
     * @throws DataContainerException
     */
    abstract protected function containerise($value): ValueContainer;

    /**
     * @phpstan-param ValueContainer<TInputValue> $value 
     * @phpstan-return ValueContainer<TPreCastedInputValue>
     */
    protected function preTypecast(ValueContainer $value): ValueContainer
    {
        if ($value instanceof TypecastedValueContainer) {
            return $value;
        }

        /** @TODO: add static guarantees that AttributeFinder only returns relevant PreTypecast for the correct TInputValue */
        $attrFinder = new AttributeFinder(static::class, PreTypecast::class);

        foreach ($attrFinder->getAttributeInstances() as $preTypecast) {
            assert($preTypecast instanceof PreTypecast);
            $value = $value->transform($preTypecast->transformer);
        }

        /** @var ValueContainer<TPreCastedInputValue> */
        return $value;
    }

    /**
     * Cast the value type before sanitisation.
     * Should be used to cast between types where appropriate (e.g. convert integer to boolean).
     *
     * @phpstan-param ValueContainer<TPreCastedInputValue> $value Initial value
     *
     * @phpstan-return TypecastedValueContainer<TCastedValue> Casted value to be sanitised and validated
     *
     * @phpstan-throws DataTypecastException<TInputValue>
     * @throws DataSanitisationException
     */
    abstract protected function typecast(ValueContainer $value): TypecastedValueContainer;

    /**
     * 
     * @phpstan-param TypecastedValueContainer<TCastedValue> $value 
     * @phpstan-return TypecastedValueContainer<TCastedValue>
     */
    protected function preSanitise(TypecastedValueContainer $value): TypecastedValueContainer
    {
        if ($value instanceof SanitisedValueContainer) {
            return $value;
        }

        /** @TODO: add static guarantees that AttributeFinder only returns relevant PreSanitisers for the correct TCastedValue */
        $attrFinder = new AttributeFinder(static::class, PreSanitise::class);

        /** @var PreSanitise<TCastedValue> */
        foreach ($attrFinder->getAttributeInstances() as $preSanitise) {
            assert($preSanitise instanceof PreSanitise);

            $value = $value->preSanitise($preSanitise->sanitiser);
        }

        return $value;
    }

    /**
     * Sanitise the value before validation.
     * Should be used to clean up the data from unnecessary, redundant or dangerous parts.
     *
     * @phpstan-param TypecastedValueContainer<TCastedValue> $value Typecasted value
     *
     * @phpstan-return SanitisedValueContainer<TSanitizedValue> Sanitised/Casted value to be validated
     *
     * @phpstan-throws DataSanitisationException<TCastedValue>
     * @throws DataSanitisationException
     */
    abstract protected function sanitise(TypecastedValueContainer $value): SanitisedValueContainer;

    /**
     * Validate the initialized instance of the type.
     * Should be called by the implementations.
     *
     * @phpstan-param SanitisedValueContainer<TSanitizedValue> $value Sanitized value to be validated
     *
     * @phpstan-return ValidatedValueContainer<TValidatedValue> Validated value
     *
     * @phpstan-throws DataValidationException<TSanitizedValue>
     * @throws DataValidationException
     */
    abstract protected function validate(SanitisedValueContainer $value): ValidatedValueContainer;
}
