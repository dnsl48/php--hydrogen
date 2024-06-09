<?php

declare(strict_types=1);

namespace Hydrogen\Attribute\Nullify;

enum Stage: int
{
    case PreTypecast = 1;
    case PreConstruct = 2;
    case PostConstruct = 4;

    case ALL = 7;
}
