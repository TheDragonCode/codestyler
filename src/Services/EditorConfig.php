<?php

declare(strict_types=1);

namespace DragonCode\CodeStyler\Services;

use DragonCode\CodeStyler\Contracts\Processor;
use DragonCode\Support\Facades\Helpers\Filesystem\File;

class EditorConfig implements Processor
{
    protected string $source = __DIR__ . '/../../.editorconfig';

    protected string $target = './.editorconfig';

    public function run(): void
    {
        if ($this->allow()) {
            File::copy($this->source, $this->target);
        }
    }

    protected function allow(): bool
    {
        return realpath($this->source) !== realpath($this->target);
    }
}
