<?php

declare(strict_types=1);

namespace DragonCode\CodeStyler\Processors;

use DragonCode\CodeStyler\Models\Input;
use DragonCode\CodeStyler\Services\Config;
use DragonCode\CodeStyler\Services\Stylers\JsonStyler;
use DragonCode\CodeStyler\Support\Json;
use DragonCode\Support\Facades\Helpers\Arr;

abstract class CodeStyler extends BaseProcessor
{
    protected array $options = [
        'path' => '.',
        'fix'  => true,
    ];

    protected array $options_check = [];

    public function run(): void
    {
        $arguments = $this->getOptions();

        // $this->jsonStyler($arguments);
        $this->phpStyler($arguments);
    }

    protected function phpStyler(Input $arguments): void
    {
        $check = $this->hasCheck() ? '--test' : '';

        $ansi = $arguments->ansi ? '--ansi' : '--no-ansi';

        echo shell_exec(sprintf('php %s %s --config %s %s', $this->pintPath(), $check, $arguments->config, $ansi));
    }

    protected function jsonStyler(Input $arguments): void
    {
        JsonStyler::make($this->output, new Json(), $arguments->path, $this->hasCheck())->handle();
    }

    protected function resolvePath(mixed $value): mixed
    {
        if (is_string($value) && file_exists($value)) {
            return realpath($value);
        }

        return $value;
    }

    protected function getOptions(): Input
    {
        return Arr::of()
            ->merge($this->options)
            ->merge($this->options_check)
            ->merge(['config' => $this->getConfigFilename()])
            ->merge($this->getDecorationOption())
            ->map(fn (mixed $value) => $this->resolvePath($value))
            ->toInstance(Input::class);
    }

    protected function getDecorationOption(): array
    {
        return ['ansi' => $this->output->isDecorated()];
    }

    protected function getConfigFilename(): string
    {
        return Config::make($this->hasRisky())->getPath();
    }

    protected function hasRisky(): bool
    {
        return $this->input->hasOption('risky') && $this->input->getOption('risky');
    }

    protected function hasCheck(): bool
    {
        return $this->options_check['--test'] ?? false;
    }

    protected function pintPath(): string
    {
        if ($path = realpath(__DIR__ . '/../../vendor/bin/pint')) {
            return $path;
        }

        return realpath(__DIR__ . '/../../modules/laravel/pint/builds/pint');

        return realpath(__DIR__ . '/../../../../bin/pint');
    }
}
