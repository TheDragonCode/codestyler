<?php

declare(strict_types=1);

namespace DragonCode\CodeStyler\Helpers;

use App\Project;
use DragonCode\Support\Facades\Application\Version;
use DragonCode\Support\Facades\Helpers\Arr;

use function preg_match_all;
use function realpath;

class PhpVersion
{
    public const DEFAULT = '8.4';
    public const MIN     = '8.2';

    public static function get(): string
    {
        if ($composer = static::composer()) {
            return static::find($composer);
        }

        return static::DEFAULT;
    }

    protected static function find(array $composer): string
    {
        preg_match_all('/\d\.\d/', static::getVersions($composer), $versions);

        return Arr::of($versions[0] ?? [])
            ->map(fn (string $version) => static::getMinVersion($version))
            ->unique()
            ->sort()
            ->values()
            ->first();
    }

    protected static function getVersions(array $composer, array $keys = ['require.php', 'require-dev.php']): string
    {
        foreach ($keys as $key) {
            if ($versions = Arr::get($composer, $key)) {
                return $versions;
            }
        }

        return self::DEFAULT;
    }

    protected static function getMinVersion(string $version): string
    {
        return Version::of($version)->gte(self::MIN) ? self::MIN : $version;
    }

    protected static function composer(): ?array
    {
        if ($path = static::path('composer.json')) {
            return Arr::ofFile($path)->toArray();
        }

        return null;
    }

    protected static function path(string $filename): bool|string
    {
        return realpath(Project::path() . '/' . $filename);
    }
}
