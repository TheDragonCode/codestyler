<?php

declare(strict_types=1);

namespace DragonCode\CodeStyler\Commands;

use App\Project;
use Illuminate\Support\Facades\File;

class PhpStormCommand extends BaseCommand
{
    protected $signature = 'phpstorm';

    protected $description = 'Publishes code-style settings for the phpStorm IDE';

    protected string $filename = 'The_Dragon_Code_phpStorm.xml';

    protected function sourcePath(): ?string
    {
        return base_path($this->filename);
    }

    protected function targetPath(): ?string
    {
        return Project::path() . '/' . $this->filename;
    }

    protected function process(): string
    {
        File::copy($this->sourcePath(), $this->targetPath());

        return self::STATUS_DONE;
    }
}
