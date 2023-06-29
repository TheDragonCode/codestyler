<?php

declare(strict_types=1);

namespace DragonCode\CodeStyler\Commands;

use LaravelZero\Framework\Commands\Command;

abstract class BaseCommand extends Command
{
    protected const STATUS_DONE = 'DONE';
    protected const STATUS_SKIP = 'SKIP';

    abstract protected function process(): string;

    abstract protected function targetPath(): ?string;

    public function handle(): int
    {
        $this->allow()
            ? $this->processInfo($this->process())
            : $this->processInfo($this->skip());

        return self::SUCCESS;
    }

    protected function sourcePath(): ?string
    {
        return null;
    }

    protected function skip(): string
    {
        return self::STATUS_SKIP;
    }

    protected function processInfo(string $status): void
    {
        $this->components->twoColumnDetail($this->description, $status);
    }

    protected function allow(): bool
    {
        $source = realpath($this->sourcePath());
        $target = realpath($this->targetPath());

        return ($source !== $target || (! $source && ! $target)) && ! empty($this->targetPath());
    }
}
