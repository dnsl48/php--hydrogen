<?php declare(strict_types = 1);

namespace Hydrogen\Value\Contract\Typecast;

interface TypecastAwareConstructor
{
    public function __construct(mixed $inputValue);
}