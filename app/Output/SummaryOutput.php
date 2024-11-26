<?php

declare(strict_types=1);

namespace DragonCode\CodeStyler\Output;

use App\Output\SummaryOutput as BaseOutput;

/** @see \DragonCode\CodeStyler\Enums\PhpVersion */
class SummaryOutput extends BaseOutput
{
    protected $presets = [
        '8.2'       => 'PHP 8.2',
        '8.2-risky' => 'PHP 8.2 with risky',
        '8.3'       => 'PHP 8.3',
        '8.3-risky' => 'PHP 8.3 with risky',
        '8.4'       => 'PHP 8.4',
        '8.4-risky' => 'PHP 8.4 with risky',
    ];
}
