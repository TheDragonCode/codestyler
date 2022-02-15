<?php

declare(strict_types=1);

namespace DragonCode\CodeStyler\Commands;

use DragonCode\CodeStyler\Contracts\Processor;
use DragonCode\CodeStyler\Processors\Fix as FixProcessor;

class Fix extends BaseCommand
{
    protected string|Processor $processor = FixProcessor::class;

    protected string $status = 'Checking and fixing the code-style...';

    protected function configure()
    {
        $this
            ->setName('fix')
            ->setDescription('Fix the codestyle of the project');
    }
}
