<?php

declare(strict_types=1);

namespace DragonCode\CodeStyler\Commands;

use DragonCode\CodeStyler\Contracts\Processor;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

abstract class BaseCommand extends Command
{
    protected InputInterface $input;
    protected OutputInterface $output;
    protected string $status;
    protected string|Processor $processor;

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $this->input = $input;
        $this->output = $output;

        $this->hello();
        $this->handle();

        return 0;
    }

    protected function hello(): void
    {
        $this->output->writeln(sprintf('<fg=green>%s</> by <fg=yellow>%s</> and contributors.', $this->getApplication()->getLongVersion(), 'Andrey Helldar'));

        $this->output->writeln('');
    }

    protected function handle(): void
    {
        $this->output->writeln($this->status);

        $this->resolveProcessor()->run();
    }

    protected function resolveProcessor(): Processor
    {
        return new $this->processor($this->input, $this->output);
    }
}
