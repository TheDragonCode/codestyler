<?php

declare(strict_types=1);

namespace DragonCode\Codestyler\Console;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

use function file_exists;
use function is_dir;
use function realpath;

class EditorConfigCommand extends Command
{
    protected function configure(): Command
    {
        return $this
            ->setName('editorconfig')
            ->setDescription('Publishes the .editorconfig file')
            ->addOption('path', 'p', InputOption::VALUE_OPTIONAL, 'Path to publish files', realpath('.'));
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $path   = $input->getOption('path');
        $source = $this->sourcePath();
        $target = $this->targetPath($path);

        if (! $this->validateDirectory($path)) {
            $output->writeln("<error>Directory \"$path\" not found.</error>");

            return static::FAILURE;
        }

        copy($source, $target);

        $output->writeln("<info>The .editorconfig file published successfully to \"$target\".</info>");

        return static::SUCCESS;
    }

    protected function validateDirectory(string $path): bool
    {
        return file_exists($path) && is_dir($path);
    }

    protected function sourcePath(): string
    {
        return __DIR__ . "/../../.editorconfig";
    }

    protected function targetPath(string $path): string
    {
        return $path . '/.editorconfig';
    }
}
