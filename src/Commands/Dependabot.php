<?php

declare(strict_types=1);

namespace DragonCode\CodeStyler\Commands;

use DragonCode\CodeStyler\Contracts\Processor;
use DragonCode\CodeStyler\Processors\Dependabot as DependabotProcessor;

class Dependabot extends BaseCommand
{
    protected string|Processor $processor = DependabotProcessor::class;

    protected string $status = 'Updating Dependabot rules...';

    protected function configure()
    {
        $this
            ->setName('dependabot')
            ->setDescription('Activation the Dependabot to monitor GitHub Actions rules');
    }
}
