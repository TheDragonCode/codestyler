<?php

declare(strict_types=1);

namespace DragonCode\CodeStyler\Services\Filesystem;

use DragonCode\CodeStyler\Contracts\Filesystem as FilesystemContract;
use DragonCode\Support\Facades\Filesystem\File;
use Symfony\Component\Yaml\Yaml as SymfonyYaml;

use function file_exists;

class Yaml implements FilesystemContract
{
    public function load(string $path): array
    {
        return file_exists($path) ? SymfonyYaml::parseFile($path) : [];
    }

    public function store(string $path, array|string $content): string
    {
        $yaml = SymfonyYaml::dump($content, 5);

        return File::store($path, $yaml);
    }
}
