<?php

declare(strict_types=1);

namespace DragonCode\CodeStyler\Commands;

use App\Project;
use Illuminate\Support\Facades\File;

use function base_path;

class EditorConfigCommand extends BaseCommand
{
    protected $signature = 'editorconfig';

    protected $description = 'Update the `.editorconfig` file';

    protected function sourcePath(): ?string
    {
        return base_path('.editorconfig');
    }

    protected function targetPath(): ?string
    {
        return Project::path() . '/.editorconfig';
    }

    protected function process(): string
    {
        File::copy($this->sourcePath(), $this->targetPath());

        return self::STATUS_DONE;
    }
}
