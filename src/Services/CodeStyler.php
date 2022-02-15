<?php

declare(strict_types=1);

namespace DragonCode\CodeStyler\Services;

use Composer\XdebugHandler\XdebugHandler;
use DragonCode\CodeStyler\Contracts\Processor;
use DragonCode\Support\Facades\Helpers\Ables\Arrayable;
use DragonCode\Support\Facades\Helpers\Arr;
use PhpCsFixer\Console\Application;
use Symfony\Component\Console\Input\ArgvInput;

abstract class CodeStyler implements Processor
{
    protected const ENV_PREFIX = 'PHP_CS_FIXER';

    protected array $options = [
        'path'   => __DIR__,
        'fix'    => true,
        '--ansi' => true,
    ];

    protected array $options_check = [];

    public function run(): void
    {
        $this->xdebug();
        $this->styler();
    }

    protected function xdebug(): void
    {
        $xdebug = new XdebugHandler(self::ENV_PREFIX);
        $xdebug->check();

        unset($xdebug);
    }

    protected function styler(): void
    {
        $application = new Application();
        $application->run($this->getArgv());
    }

    protected function getArgv(): ArgvInput
    {
        return new ArgvInput(
            $this->resolveOptions()
        );
    }

    protected function resolveOptions(): array
    {
        return Arrayable::of($this->getOptions())
            ->map(function ($value, string $key) {
                if (is_bool($value)) {
                    return $key;
                }

                return sprintf('%s=%s', $key, $this->resolvePath($value));
            })
            ->values()
            ->get();
    }

    protected function resolvePath($value)
    {
        if (is_string($value) && file_exists($value)) {
            return realpath($value);
        }

        return $value;
    }

    protected function getOptions(): array
    {
        return array_merge($this->options, [
            '--config' => $this->getConfigFilename(),
        ], $this->options_check);
    }

    protected function getConfigFilename(): string
    {
        $path = __DIR__ . '/../../rules/';

        $config = $path . $this->getPhpVersion() . '.php';

        return file_exists($config) ? $config : $path . '8.1.php';
    }

    protected function getPhpVersion(): ?string
    {
        $path = realpath('./composer.json');

        if (file_exists($path)) {
            $composer = json_decode(file_get_contents($path), true);

            $version = Arr::get($composer, 'require.php', Arr::get($composer, 'require-dev.php', ''));

            preg_match_all('/\d\.\d/', $version, $output);

            $versions = $output[0];

            sort($versions);

            $versions = Arrayable::of($versions)
                ->filter(static fn (string $value) => version_compare($value, '7.4', '>='))
                ->values()
                ->get();

            return $versions[0] ?? null;
        }

        return null;
    }
}
