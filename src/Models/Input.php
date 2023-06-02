<?php

declare(strict_types=1);

namespace DragonCode\CodeStyler\Models;

class Input
{
    public string $path;

    public string $config;

    public bool $ansi;

    public function __construct(array $data)
    {
        foreach ($data as $key => $value) {
            $this->set($key, $value);
        }
    }

    protected function set(mixed $name, mixed $value): void
    {
        if (property_exists($this, $name)) {
            $this->{$name} = $value;
        }
    }
}
