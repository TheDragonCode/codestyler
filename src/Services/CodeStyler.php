<?php

declare(strict_types=1);

namespace DragonCode\CodeStyler\Services;

use Composer\XdebugHandler\XdebugHandler;
use DragonCode\CodeStyler\Contracts\Processor;
use DragonCode\Support\Facades\Helpers\Ables\Arrayable;
use PhpCsFixer\Console\Application;
use Symfony\Component\Console\Input\ArgvInput;

abstract class CodeStyler implements Processor
{
    protected const ENV_PREFIX = 'PHP_CS_FIXER';

    protected array $options = [
        'path'     => __DIR__,
        'fix'      => true,
        '--config' => __DIR__ . '/../../config/rules.php',
        '--ansi'   => true,
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
            ->map(function (mixed $value, string $key) {
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
        return array_merge($this->options, $this->options_check);
    }
}
