<?php

declare(strict_types=1);

namespace DragonCode\CodeStyler\Services\Filesystem;

use DragonCode\CodeStyler\Contracts\Filesystem as FilesystemContract;
use DragonCode\Support\Facades\Filesystem\File;
use Seld\JsonLint\JsonParser;

class Json implements FilesystemContract
{
    public function __construct(
        protected readonly JsonParser $parser
    ) {}

    public function load(string $path): array
    {
        $this->parser->parse($path);

        return File::load($path);
    }

    public function store(string $path, array|string $content): string
    {
        $json = json_encode($content, JSON_PRETTY_PRINT ^ JSON_UNESCAPED_SLASHES ^ JSON_UNESCAPED_UNICODE);

        return File::store($path, $json);
    }
}
