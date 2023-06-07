<?php

declare(strict_types=1);

namespace DragonCode\CodeStyler\Commands;

use Illuminate\Support\Facades\File;

class EditorConfigCommand extends BaseCommand
{
    protected $signature = 'editorconfig';

    protected $description = 'Update the `.editorconfig` file';

    protected string $source = __DIR__ . '/../../.editorconfig';

    protected string $target = './.editorconfig';

    protected function process(): string
    {
        File::copy($this->source, $this->target);

        return self::STATUS_DONE;
    }
}
