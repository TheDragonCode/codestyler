<?php

declare(strict_types=1);

namespace DragonCode\CodeStyler\Commands;

use DragonCode\CodeStyler\Contracts\Processor;
use DragonCode\CodeStyler\Processors\Fix as FixProcessor;
use Symfony\Component\Console\Input\InputOption;

class Fix extends BaseCommand
{
    protected string|Processor $processor = FixProcessor::class;
    protected string $status = 'Checking and fixing the code-style...';

    protected function configure(): void
    {
        $this
            ->setName('fix')
            ->setDescription('Fix the code-style of the project')
            ->addOption('risky', null, InputOption::VALUE_NONE, 'Allows to set whether risky rules may run');
    }
}
