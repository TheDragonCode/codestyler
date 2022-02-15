<?php

declare(strict_types=1);

namespace DragonCode\CodeStyler\Processors;

use DragonCode\Support\Facades\Helpers\Filesystem\File;

class EditorConfig extends BaseProcessor
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
