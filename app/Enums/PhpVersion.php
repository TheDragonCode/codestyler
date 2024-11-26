<?php

declare(strict_types=1);

namespace DragonCode\CodeStyler\Enums;

use ArchTech\Enums\Values;

enum PhpVersion: string
{
    use Values;

    case v82      = '8.2';
    case v82risky = '8.2-risky';
    case v83      = '8.3';
    case v83risky = '8.3-risky';
    case v84      = '8.4';
    case v84risky = '8.4-risky';
}
