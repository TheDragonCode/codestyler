<?php

declare(strict_types=1);

namespace DragonCode\CodeStyler\Processors;

use DragonCode\CodeStyler\Support\PhpVersion;
use DragonCode\Support\Facades\Helpers\Arr;
use PhpCsFixer\Console\Application;
use Symfony\Component\Console\Input\ArgvInput;

abstract class CodeStyler extends BaseProcessor
{
    protected array $options = [
        'path' => __DIR__,
        'fix'  => true,
    ];

    protected array $options_check = [];

    public function run(): void
    {
        $this->styler();
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
        return Arr::of($this->getOptions())
            ->map(function ($value, string $key)
            {
                if (is_bool($value)) {
                    return $key;
                }

                return sprintf('%s=%s', $key, $this->resolvePath($value));
            })
            ->values()
            ->toArray();
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
        return array_merge($this->options, $this->options_check, [
            '--config' => $this->getConfigFilename(),
        ], $this->getDecorationOption());
    }

    protected function getDecorationOption(): array
    {
        return $this->output->isDecorated()
            ? ['--ansi' => true]
            : ['--no-ansi' => true];
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
