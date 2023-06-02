<?php

declare(strict_types=1);

namespace DragonCode\CodeStyler\Support;

use DragonCode\Contracts\Support\Filesystem;
use DragonCode\Support\Facades\Filesystem\File;
use DragonCode\Support\Facades\Helpers\Arr;

class Json implements Filesystem
{
    public function load(string $path): array
    {
        return Arr::ofFile($path)->toArray();
    }

    public function store(string $path, $content): string
    {
        return File::store($path, trim($content) . PHP_EOL);
    }
}
