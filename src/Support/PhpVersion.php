<?php

declare(strict_types=1);

namespace DragonCode\CodeStyler\Support;

use DragonCode\Support\Concerns\Makeable;
use DragonCode\Support\Facades\Application\Version;
use DragonCode\Support\Facades\Helpers\Arr;

class PhpVersion
{
    use Makeable;

    public const DEFAULT = '8.1';

    public const MIN = '7.2';

    public function get(): string
    {
        if ($composer = $this->composer()) {
            return $this->find($composer);
        }

        return self::DEFAULT;
    }

    protected function find(array $composer)
    {
        preg_match_all('/\d\.\d/', (string) $this->getVersions($composer), $output);

        return Arr::of($output[0])
            ->map(fn (string $value) => $this->getMinVersion($value))
            ->unique()
            ->sort()
            ->values()
            ->first(default: self::DEFAULT);
    }

    protected function getVersions(array $composer, array $keys = ['require.php', 'require-dev.php']): ?string
    {
        foreach ($keys as $key) {
            if ($versions = Arr::get($composer, $key)) {
                return $versions;
            }
        }

        return null;
    }

    protected function getMinVersion(string $version): string
    {
        return Version::of($version)->gt(self::MIN) ? self::MIN : $version;
    }

    protected function composer(): ?array
    {
        if ($path = realpath('./composer.json')) {
            return Arr::ofFile($path)->toArray();
        }

        return null;
    }
}
