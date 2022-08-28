<?php

declare(strict_types=1);

namespace Tests\Fixtures\Support;

use DragonCode\CodeStyler\Support\PhpVersion as BasePhpVersion;

class PhpVersion extends BasePhpVersion
{
    protected array $composer = [];

    public function setComposer(array $values): self
    {
        $this->composer = $values;

        return $this;
    }

    protected function composer(): ?array
    {
        return $this->composer;
    }
}
