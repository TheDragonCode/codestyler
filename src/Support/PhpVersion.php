<?php

declare(strict_types=1);

namespace DragonCode\CodeStyler\Support;

use DragonCode\Support\Concerns\Makeable;
use DragonCode\Support\Facades\Application\Version;
use DragonCode\Support\Facades\Helpers\Arr;

class PhpVersion
{
    use Makeable;

    public const DEFAULT = '8.2';

    public const MIN = '8.1';

    public function get(): string
    {
        if ($composer = $this->composer()) {
            return $this->find($composer);
        }

        return self::DEFAULT;
    }

    protected function find(array $composer): string
    {
        preg_match_all('/\d\.\d/', $this->getVersions($composer), $versions);

        return Arr::of($versions[0] ?? [])
            ->map(fn (string $version) => $this->getMinVersion($version))
            ->unique()
            ->sort()
            ->values()
            ->first();
    }

    protected function getVersions(array $composer, array $keys = ['require.php', 'require-dev.php']): string
    {
        foreach ($keys as $key) {
            if ($versions = Arr::get($composer, $key)) {
                return $versions;
            }
        }

        return self::DEFAULT;
    }

    protected function getMinVersion(string $version): string
    {
        return Version::of($version)->gte(self::MIN) ? self::MIN : $version;
    }

    protected function composer(): ?array
    {
        if ($path = realpath('./composer.json')) {
            return Arr::ofFile($path)->toArray();
        }

        dump('composer.json file not found in the current directory.', __DIR__);

        return null;
    }
}
