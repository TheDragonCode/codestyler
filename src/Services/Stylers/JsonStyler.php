<?php

declare(strict_types=1);

namespace DragonCode\CodeStyler\Services\Stylers;

use DragonCode\Contracts\Support\Filesystem;
use DragonCode\Support\Concerns\Makeable;
use DragonCode\Support\Facades\Filesystem\File;
use DragonCode\Support\Facades\Filesystem\Path;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * @method static JsonStyler make(string $path, bool $hasCheck, Filesystem $filesystem, OutputInterface $output)
 */
class JsonStyler
{
    use Makeable;

    protected int $flags = JSON_NUMERIC_CHECK
    ^ JSON_PRESERVE_ZERO_FRACTION
    ^ JSON_PRETTY_PRINT
    ^ JSON_UNESCAPED_UNICODE
    ^ JSON_UNESCAPED_LINE_TERMINATORS
    ^ JSON_PARTIAL_OUTPUT_ON_ERROR;

    protected bool $isCorrect = true;

    public function __construct(
        protected string $path,
        protected bool $hasCheck,
        protected Filesystem $filesystem,
        protected OutputInterface $output
    ) {
    }

    public function handle(): void
    {
        $this->run();
        $this->finish();
    }

    protected function run(): void
    {
        foreach ($this->files() as $file) {
            $this->hasCheck
                ? $this->check($file)
                : $this->fix($file);
        }
    }

    protected function finish(): void
    {
        if (! $this->isCorrect && $this->hasCheck) {
            exit(0);
        }
    }

    protected function check(string $path): void
    {
        $json  = $this->read($path);
        $value = $this->load($path);

        $styled = $this->stylize($value);

        if (trim($json) !== trim($styled)) {
            $this->output->writeln($path);
            $this->output->writeln($this->diff($styled, $json));

            $this->isCorrect = false;
        }
    }

    protected function fix(string $path): void
    {
        $value = $this->load($path);

        $this->store($path, $this->stylize($value));
    }

    protected function diff(string $expected, string $actual): string
    {
        return xdiff_string_diff($expected, $actual) ?: 'Error getting string difference';
    }

    protected function stylize(array $value): string
    {
        return $this->encode($value);
    }

    protected function read(string $path): string
    {
        return file_get_contents($path);
    }

    protected function load(string $path): array
    {
        return $this->filesystem->load($path);
    }

    protected function store(string $path, string $content): void
    {
        $this->filesystem->store($path, $content);
    }

    protected function encode(array $value): string
    {
        return json_encode($value, $this->flags);
    }

    protected function files(): array
    {
        return File::allPaths($this->path, $this->fileExtensionFilter(), true);
    }

    protected function fileExtensionFilter(): callable
    {
        return fn (string $filename) => Path::extension($filename) === 'json';
    }
}
