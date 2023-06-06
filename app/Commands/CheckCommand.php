<?php

declare(strict_types=1);

namespace DragonCode\CodeStyler\Commands;

use LaravelZero\Framework\Commands\Command;

use function Termwind\render;

class CheckCommand extends Command
{
    protected $signature = 'check';

    protected $description = 'Check code-style';

    public function handle(): void
    {
        render(<<<'HTML'
            <div class="py-1 ml-2">
                <div class="px-1 bg-blue-300 text-black">Laravel Zero</div>
                <em class="ml-1">
                  Simplicity is the ultimate sophistication.
                </em>
            </div>
        HTML
        );
    }
}
