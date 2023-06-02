<?php

declare(strict_types=1);

namespace DragonCode\CodeStyler\Processors;

class Check extends CodeStyler
{
    protected array $options_check = [
        '--test' => true,
        '--diff' => true,
    ];
}
