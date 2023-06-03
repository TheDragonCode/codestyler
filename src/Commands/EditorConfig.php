<?php

declare(strict_types=1);

namespace DragonCode\CodeStyler\Commands;

use DragonCode\CodeStyler\Contracts\Processor;
use DragonCode\CodeStyler\Processors\EditorConfig as EditorConfigProcessor;

class EditorConfig extends BaseCommand
{
    protected string|Processor $processor = EditorConfigProcessor::class;
    protected string $status = 'Updating .editorconfig...';

    protected function configure(): void
    {
        $this
            ->setName('editorconfig')
            ->setDescription('Update the `.editorconfig` file');
    }
}
