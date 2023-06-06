<?php

declare(strict_types=1);

namespace DragonCode\CodeStyler\Contracts;

interface Filesystem
{
    public function load(string $path): array;

    public function store(string $path, array|string $content): string;
}
