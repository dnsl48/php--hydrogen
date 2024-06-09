<?php

declare(strict_types=1);

namespace Hydrogen\Tests\Hydrogen\Value\Trait;

enum EnumBackedStr: string
{
    case A = 'A';
    case B = 'B';
}
