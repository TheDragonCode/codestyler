<?php

declare(strict_types=1);

namespace DragonCode\CodeStyler\Commands;

use NunoMaduro\LaravelConsoleSummary\SummaryCommand;

class DefaultCommand extends SummaryCommand
{
    protected const FORMAT = 'txt';

    protected string $name = 'default';

    protected string $description = 'Default command';
}
