<?php

declare(strict_types=1);

namespace DragonCode\CodeStyler\Concerns;

use DragonCode\CodeStyler\Support\Yaml;
use DragonCode\Contracts\Support\Filesystem;
use DragonCode\Support\Concerns\Resolvable;

trait Files
{
    use Resolvable;

    protected function filesystem(): Filesystem
    {
        return self::resolveInstance(Yaml::class);
    }
}
