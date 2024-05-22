<?php declare(strict_types = 1);

namespace Hydrogen\Value\Contract\Typecast;

interface ToNativeBool
{
    public function toNativeBool(): bool;
}