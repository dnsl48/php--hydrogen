<?php declare(strict_types = 1);

namespace Hydrogen\Value\Contract\Typecast;

interface ToNativeFloat
{
    public function toNativeFloat(): float;
}