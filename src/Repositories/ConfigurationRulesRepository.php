<?php

declare(strict_types=1);

namespace DragonCode\CodeStyler\Repositories;

use App\Repositories\ConfigurationJsonRepository;
use DragonCode\CodeStyler\Support\PhpVersion;
use DragonCode\Support\Facades\Filesystem\File;

class ConfigurationRulesRepository extends ConfigurationJsonRepository
{
    protected array $config = [];

    protected function get(): array
    {
        if (! empty($this->config)) {
            return $this->config;
        }

        return $this->config = array_merge($this->default(), $this->version());
    }

    protected function version(): array
    {
        $filename = $this->phpVersion() . ($this->risky ? '-risky' : '');

        return $this->loadRules($filename);
    }

    protected function default(): array
    {
        return $this->loadRules('default');
    }

    protected function loadRules(string $filename): array
    {
        return File::load(__DIR__ . "/../../rules/$filename.php");
    }

    protected function phpVersion(): string
    {
        return PhpVersion::make()->get();
    }
}
