<?php

declare(strict_types=1);

namespace DragonCode\CodeStyler\Services\Stylers;

use DragonCode\Contracts\Support\Filesystem;
use DragonCode\PrettyArray\Services\Formatter;
use DragonCode\Support\Concerns\Makeable;
use PhpCsFixer\Config;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Finder\SplFileInfo;

/**
 * @method static JsonStyler make(OutputInterface $output, Config $rulesConfig, Filesystem $filesystem, bool $hasCheck)
 */
class JsonStyler
{
    use Makeable;

    protected bool $isCorrect = true;

    protected int $fileNumber = 1;

    public function __construct(
        protected OutputInterface $output,
        protected Config          $rulesConfig,
        protected Filesystem      $filesystem,
        protected bool            $hasCheck,
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
                ? $this->check($file->getRealPath())
                : $this->fix($file->getRealPath());
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
            $this->output->writeln(sprintf('%d) %s', $this->fileNumber, $path));
            $this->output->writeln('---------- begin diff ----------');

            $this->output->writeln($this->diff($styled, $json));

            $this->output->writeln('----------- end diff -----------');

            $this->isCorrect = false;

            ++$this->fileNumber;
        }
    }

    protected function fix(string $path): void
    {
        $value = $this->load($path);

        $this->store($path, $this->stylize($value));
    }

    protected function diff(string $expected, string $actual): string
    {
        return xdiff_string_diff($actual, $expected) ?: 'Error getting string difference';
    }

    protected function stylize(array $value): string
    {
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

    /**
     * @return iterable<SplFileInfo>
     */
    protected function files(): iterable
    {
        return $this->rulesConfig->getFinder()
            ->name('/\.json$/')
            ->files();
    }
}