<?php

declare(strict_types=1);

namespace DragonCode\CodeStyler\Commands;

use DragonCode\CodeStyler\Services\Filesystem\Filesystem;
use DragonCode\Support\Facades\Helpers\Arr;

class DependabotCommand extends BaseCommand
{
    protected const NAME = 'github-actions';

    protected const VERSION = 2;

    protected $signature = 'dependabot';

    protected $description = 'Update Dependabot rules';

    protected string $source = '';

    protected string $target = './.github/dependabot.yml';

    protected array $content = [
        'package-ecosystem' => self::NAME,

        'directory' => '/',

        'schedule' => [
            'interval' => 'daily',
        ],
    ];

    public function process(): string
    {
        $content = $this->file()->load($this->target);

        $updates = $this->updates($content['updates'] ?? []);
        $version = $this->version();

        $this->store($version, $updates);

        return self::STATUS_DONE;
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
        $this->file()->store($this->target, compact('version', 'updates'));
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
