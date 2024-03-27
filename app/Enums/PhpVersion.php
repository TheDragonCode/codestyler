<?php

declare(strict_types=1);

namespace DragonCode\CodeStyler\Enums;

use ArchTech\Enums\Values;

enum PhpVersion: string
{
    use Values;

    case v81      = '8.1';
    case v81risky = '8.1-risky';
    case v82      = '8.2';
    case v82risky = '8.2-risky';
    case v83      = '8.3';
    case v83risky = '8.3-risky';
}
