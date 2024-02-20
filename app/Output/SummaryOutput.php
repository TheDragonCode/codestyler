<?php

declare(strict_types=1);

namespace DragonCode\CodeStyler\Output;

use App\Output\SummaryOutput as BaseOutput;

class SummaryOutput extends BaseOutput
{
    protected $presets = [
        '8.1'       => 'PHP 8.1',
        '8.1-risky' => 'PHP 8.1 with risky',
        '8.2'       => 'PHP 8.2',
        '8.2-risky' => 'PHP 8.2 with risky',
        '8.3'       => 'PHP 8.3',
        '8.3-risky' => 'PHP 8.3 with risky',
    ];
}
