<?php

declare(strict_types=1);

namespace DragonCode\CodeStyler\Services\Filesystem;

use DragonCode\CodeStyler\Contracts\Filesystem as FilesystemContract;
use DragonCode\Support\Facades\Filesystem\Path;

use function resolve;

class Filesystem implements FilesystemContract
{
    public function load(string $path): array
    {
        return $this->service($path)->load($path);
    }

    public function store(string $path, array|string $content): string
    {
        return $this->service($path)->store($path, $content);
    }

    protected function service(string $path): FilesystemContract
    {
        return match ($this->extension($path)) {
            'yaml', 'yml' => resolve(Yaml::class),
        };
    }

    protected function extension(string $path): string
    {
        return Path::extension($path);
    }
}
