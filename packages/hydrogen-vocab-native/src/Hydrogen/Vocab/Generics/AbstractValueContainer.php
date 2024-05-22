<?php declare(strict_types = 1);

namespace Hydrogen\Vocab\Generics;
use Hydrogen\Contract\Transformer;
use Hydrogen\Value\Contract\Container\ValueContainer;
use Override;

/**
 * @phpstan-template T
 *
 * @phpstan-implements ValueContainerInterface<T>
 */
abstract class AbstractValueContainer implements ValueContainerInterface
{
    #[Override]
    public function __construct(
        /** @phpstan-var T */
        private readonly mixed $value
    ) {}

    /**
     * @phpstan-return T
     */
    #[Override]
    public function getValue(): mixed
    {
        return $this->value;
    }

    /**
     * @phpstan-template R
     *
     * @phpstan-param Transformer<T, R> $transformer
     * @phpstan-return ValueContainerInterface<R>
     */
    #[Override]
    public function transform(Transformer $transformer): ValueContainerInterface
    {
        return new static($transformer($this->getValue()));
    }
}