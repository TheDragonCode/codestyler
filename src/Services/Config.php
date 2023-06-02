<?php

declare(strict_types=1);

namespace DragonCode\CodeStyler\Services;

use DragonCode\CodeStyler\Support\PhpVersion;
use DragonCode\Support\Concerns\Makeable;
use DragonCode\Support\Facades\Filesystem\File;
use DragonCode\Support\Facades\Helpers\Arr;

/**
 * @method static Config make(bool $risky = false)
 */
class Config
{
    use Makeable;

    protected string $path = __DIR__.'/../../rules/';

    public function __construct(
        protected readonly bool $risky = false
    ) {
    }

    public function getPath(): string
    {
        $main = $this->loadMain();
        $version = $this->resolveVersion();

        return $this->store(
            $this->resolvePath('current'),
            $this->merge($main, $version)
        );
    }

    protected function merge(array $main, array $version): array
    {
        return Arr::merge($main, $version);
    }

    protected function loadMain(): array
    {
        return $this->load(
            $this->resolvePath('main')
        );
    }

    protected function resolveVersion(): array
    {
        return $this->load(
            $this->resolvePath($this->phpVersion(), $this->risky)
        );
    }

    protected function load(string $path): array
    {
        return Arr::ofFile($path)->toArray();
    }

    protected function store(string $path, array $config): string
    {
        return File::store($path, json_encode($config));
    }

    protected function resolvePath(string $version, bool $risky = false): string
    {
        $risky = $risky ? '-risky' : '';

        return $this->path.$version.$risky.'.json';
    }

    protected function phpVersion(): string
    {
        return PhpVersion::make()->get();
    }
}
