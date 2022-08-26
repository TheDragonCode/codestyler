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

    protected function configure()
    {
        $this
            ->setName('check')
            ->setDescription('Checking the codestyle of the project')
            ->addOption('risky', null, InputOption::VALUE_OPTIONAL, 'Allows to set whether risky rules may run', 'no');
    }
}
