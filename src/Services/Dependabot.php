<?php

declare(strict_types=1);

namespace DragonCode\CodeStyler\Services;

use DragonCode\CodeStyler\Contracts\Processor;
use DragonCode\Support\Facades\Helpers\Arr;

class Dependabot implements Processor
{
    protected const VERSION = 2;

    protected const NAME = 'github-actions';

    protected string $path = './.github/dependabot.yml';

    protected array $update = [
        'package-ecosystem' => self::NAME,

        'directory' => '/',

        'schedule' => [
            'interval' => 'daily',
        ],
    ];

    protected array $content = [];

    public function __construct()
    {
        $this->content = $this->parse();
    }

    public function run(): void
    {
        $updates = $this->each($this->getUpdates());
        $version = $this->getVersion();

        $this->store($version, $updates);
    }

    protected function each(array $updates): array
    {
        $found = false;

        foreach ($updates as &$update) {
            if (Arr::get($update, 'package-ecosystem') === self::NAME) {
                $update = $this->update;
                $found  = true;
                break;
            }
        }

        return $found ? $updates : $this->put($updates);
    }

    protected function put(array $updates): array
    {
        $updates[] = $this->update;

        return $updates;
    }

    protected function store(int $version, array $updates): void
    {
        yaml_emit_file($this->path, compact('version', 'updates'));
    }

    protected function getUpdates(): array
    {
        return Arr::get($this->content, 'updates', []);
    }

    protected function getVersion(): int
    {
        return self::VERSION;
    }

    protected function parse(): array
    {
        return $this->exists() ? yaml_parse_file($this->path) : [];
    }

    protected function exists(): bool
    {
        return file_exists($this->path);
    }
}
