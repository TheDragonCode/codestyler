<?php

declare(strict_types=1);

namespace DragonCode\CodeStyler\Support;

use DragonCode\Contracts\Support\Filesystem;
use DragonCode\Support\Facades\Filesystem\File;
use Symfony\Component\Yaml\Yaml as SymfonyYaml;

class Yaml implements Filesystem
{
    public function load(string $path): array
    {
        return file_exists($path) ? SymfonyYaml::parseFile($path) : [];
    }

    public function store(string $path, $content): string
    {
        $yaml = SymfonyYaml::dump($content, 5);

        File::store($path, $yaml);

        return $path;
    }
}
