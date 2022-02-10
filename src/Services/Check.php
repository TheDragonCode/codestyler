<?php

declare(strict_types=1);

namespace DragonCode\CodeStyler\Services;

class Check extends CodeStyler
{
    protected array $options_check = [
        '--dry-run' => true,
        '--diff'    => true,
    ];
}
