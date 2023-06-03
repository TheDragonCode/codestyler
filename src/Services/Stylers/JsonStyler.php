<?php

declare(strict_types=1);

namespace DragonCode\CodeStyler\Services\Stylers;

use DragonCode\Contracts\Support\Filesystem;
use DragonCode\PrettyArray\Services\Formatter;
use DragonCode\Support\Concerns\Makeable;
use DragonCode\Support\Facades\Filesystem\File;
use DragonCode\Support\Facades\Filesystem\Path;
use DragonCode\Support\Facades\Helpers\Arr;
use DragonCode\Support\Facades\Helpers\Str;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * @method static JsonStyler make(OutputInterface $output, Filesystem $filesystem, string $path, bool $hasCheck)
 */
class JsonStyler
{
    use Makeable;

    protected bool $isCorrect = true;

    protected int $fileNumber = 1;

    protected array $excludes = [
        '.git',
        '.github',
        '.husky',
        '.idea',
        '.next',
        '.vscode',
        'bootstrap',
        'node_modules',
        'storage',
        'tests',
        'vendor',

        'composer.json',
        'package.json',
        'package-lock.json',
    ];

    public function __construct(
        protected OutputInterface $output,
        protected Filesystem $filesystem,
        protected string $path,
        protected bool $hasCheck,
    ) {
        $this->resolveExcludes();
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
        if (!$this->isCorrect && $this->hasCheck) {
            exit(0);
        }
    }

    protected function check(string $path): void
    {
        $json = $this->read($path);
        $value = $this->load($path);

        $styled = $this->stylize($value);

        if (trim($json) !== trim($styled) && $diff = $this->diff($styled, $json)) {
            $this->showDiff($path, $diff);
        }
    }

    protected function fix(string $path): void
    {
        $value = $this->load($path);
        $source = $this->read($path);

        $stylized = $this->stylize($value);

        if ($diff = $this->diff($stylized, $source)) {
            $this->store($path, $stylized);
            $this->showDiff($path, $diff, false);
        }
    }

    protected function showDiff(string $path, string $diff, bool $full = true): void
    {
        $this->output->writeln(sprintf('%d) %s', $this->fileNumber, $path));

        if ($full) {
            $this->output->writeln('---------- begin diff ----------');
            $this->output->writeln($diff);
            $this->output->writeln('----------- end diff -----------');
        }

        $this->isCorrect = false;

        ++$this->fileNumber;
    }

    protected function diff(string $expected, string $actual): string
    {
        if (extension_loaded('xdiff')) {
            return xdiff_string_diff($actual, $expected);
        }

        return $actual !== $expected ? 'Difference found' : '';
    }

    protected function stylize(array $value): string
    {
        $value = Arr::ksort($value);

        $service = Formatter::make();

        $service->asJson();

        return $service->raw($value);
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

    protected function files(): array
    {
        return File::allPaths($this->path, fn (string $path) => $this->allowFile($path), true);
    }

    protected function allowFile(string $path): bool
    {
        return $this->isJson($path) && !$this->hasExclude($path);
    }

    protected function isJson(string $path): bool
    {
        return 'json' === Path::extension($path);
    }

    protected function hasExclude(string $path): bool
    {
        return Str::startsWith($path, $this->excludes);
    }

    protected function resolveExcludes(): void
    {
        $this->excludes = Arr::of($this->excludes)
            ->map(fn (string $name) => realpath($this->path . '/' . $name))
            ->filter(fn (mixed $value) => is_string($value))
            ->values()
            ->toArray();
    }
}
