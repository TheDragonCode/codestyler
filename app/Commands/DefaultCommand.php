<?php

declare(strict_types=1);

namespace DragonCode\CodeStyler\Commands;

use LaravelZero\Framework\Commands\Command;

class DefaultCommand extends Command
{
    protected $name = 'default';

    protected $description = 'Default command';

    public function handle(): void
    {
        $this->newLine();

        $this->line('<fg=gray>' . config('app.name') . '</>  <info>' . config('app.version') . '</info>');

        $this->newLine();

        $this->line('<info>check</info>        Check code-style');
        $this->line('<info>dependabot</info>   Update Dependabot rules');
        $this->line('<info>editorconfig</info> Update the `.editorconfig` file');
        $this->line('<info>fix</info>          Fix code-style');
    }
}
