<?php

declare(strict_types=1);

namespace DragonCode\CodeStyler\Commands;

use App\Project;
use DragonCode\CodeStyler\Services\Filesystem\Filesystem;
use DragonCode\Support\Facades\Helpers\Arr;

use function compact;
use function resolve;

class DependabotCommand extends BaseCommand
{
    protected const NAME    = 'github-actions';
    protected const VERSION = 2;

    protected $signature = 'dependabot';

    protected $description = 'Update Dependabot rules';

    protected array $content = [
        'package-ecosystem' => self::NAME,

        'directory' => '/',

        'schedule' => [
            'interval' => 'daily',
        ],
    ];

    protected function targetPath(): ?string
    {
        return Project::path() . '/.github/dependabot.yml';
    }

    protected function process(): string
    {
        $content = $this->file()->load($this->targetPath());

        $updates = $this->updates($content['updates'] ?? []);
        $version = $this->version();

        $this->store($version, $updates);

        return self::STATUS_DONE;
    }

    protected function allow(): bool
    {
        return true;
    }

    protected function updates(array $items): array
    {
        foreach ($items as &$item) {
            if (self::NAME === Arr::get($item, 'package-ecosystem')) {
                $item = $this->content;

                return $items;
            }
        }

        return Arr::push($items, $this->content);
    }

    protected function store(int $version, array $updates): void
    {
        $this->file()->store($this->targetPath(), compact('version', 'updates'));
    }

    protected function file(): Filesystem
    {
        return resolve(Filesystem::class);
    }

    protected function version(): int
    {
        return self::VERSION;
    }
}
