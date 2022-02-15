<?php

declare(strict_types=1);

namespace DragonCode\CodeStyler\Services;

use Composer\XdebugHandler\XdebugHandler;
use DragonCode\CodeStyler\Contracts\Processor;
use DragonCode\CodeStyler\Support\PhpVersion;
use DragonCode\Support\Facades\Helpers\Ables\Arrayable;
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

    protected function resolvePath(mixed $value): mixed
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

        return file_exists($config) ? $config : $path . PhpVersion::DEFAULT . '.php';
    }

    protected function getPhpVersion(): string
    {
        return PhpVersion::make()->get();
    }
}
