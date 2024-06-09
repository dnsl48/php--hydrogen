<?php

declare(strict_types=1);

namespace Hydrogen\Value\Contract\Typecast;

interface ToNativeInt
{
    public function toNativeInt(): int;
}
