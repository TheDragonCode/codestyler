<?php

declare(strict_types=1);

namespace DragonCode\CodeStyler\Commands;

use DragonCode\CodeStyler\Contracts\Processor;
use DragonCode\CodeStyler\Processors\Check as CheckProcessor;
use Symfony\Component\Console\Input\InputOption;

class Check extends BaseCommand
{
    protected string|Processor $processor = CheckProcessor::class;

    protected string $status = 'Checking code-style...';

    protected function configure(): void
    {
        $this
            ->setName('check')
            ->setDescription('Checking the code-style of the project')
            ->addOption('risky', null, InputOption::VALUE_NONE, 'Allows to set whether risky rules may run');
    }
}
