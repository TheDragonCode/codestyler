<?php

declare(strict_types=1);

namespace DragonCode\CodeStyler\Processors;

use DragonCode\CodeStyler\Support\PhpVersion;
use DragonCode\Support\Facades\Helpers\Arr;
use PhpCsFixer\Console\Application;
use Symfony\Component\Console\Input\ArgvInput;

abstract class CodeStyler extends BaseProcessor
{
    protected string $config_path = __DIR__ . '/../../rules/';

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
            ->map(function ($value, string $key) {
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
        ], $this->getDecorationOption(), $this->getRiskyOption());
    }

    protected function getDecorationOption(): array
    {
        return $this->output->isDecorated()
            ? ['--ansi' => true]
            : ['--no-ansi' => true];
    }

    protected function getRiskyOption(): array
    {
        return $this->hasRisky()
            ? ['--allow-risky' => 'yes']
            : ['--allow-risky' => 'no'];
    }

    protected function getConfigFilename(): string
    {
        $risky = $this->hasRisky() ? '-risky' : '';

        return $this->config_path . $this->getPhpVersion() . $risky . '.php';
    }

    protected function getPhpVersion(): string
    {
        return PhpVersion::make()->get();
    }

    protected function hasRisky(): bool
    {
        return $this->input->hasOption('risky') && $this->input->getOption('risky');
    }
}
