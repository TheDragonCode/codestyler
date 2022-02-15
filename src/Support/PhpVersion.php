<?php

declare(strict_types=1);

namespace DragonCode\CodeStyler\Support;

use DragonCode\Support\Concerns\Makeable;
use DragonCode\Support\Facades\Helpers\Ables\Arrayable;
use DragonCode\Support\Facades\Helpers\Arr;

class PhpVersion
{
    use Makeable;

    public const DEFAULT = '8.1';

    public function get(): string
    {
        if ($composer = $this->composer()) {
            return $this->find($composer);
        }

        return self::DEFAULT;
    }

    protected function find(array $composer)
    {
        $version = Arr::get($composer, 'require.php', Arr::get($composer, 'require-dev.php', ''));

        preg_match_all('/\d\.\d/', $version, $output);

        sort($output[0]);

        $versions = Arrayable::of($output[0])
            ->filter(static fn (string $value) => version_compare($value, '7.2', '>='))
            ->values()
            ->get();

        return $versions[0] ?? self::DEFAULT;
    }

    protected function composer(): ?array
    {
        if ($path = realpath('./composer.json')) {
            return file_exists($path) ? json_decode(file_get_contents($path), true) : null;
        }

        return null;
    }
}
