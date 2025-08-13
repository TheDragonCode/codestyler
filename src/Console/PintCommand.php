<?php

declare(strict_types=1);

namespace DragonCode\Codestyler\Console;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

use function file_exists;
use function is_dir;
use function realpath;

class PintCommand extends Command
{
    protected function configure(): Command
    {
        return $this
            ->setName('pint')
            ->setDescription('Publishes presets for the Laravel Pint')
            ->addArgument('preset', InputArgument::REQUIRED, 'The name of the preset')
            ->addOption('path', 'p', InputOption::VALUE_OPTIONAL, 'Path to publish files', realpath('.'));
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $version = $input->getArgument('preset');
        $path    = $input->getOption('path');

        if (! $this->validateVersion($version)) {
            $output->writeln("<error>Preset \"$version\" not found for Laravel Pint.</error>");

            return static::FAILURE;
        }

        if (! $this->validateDirectory($path)) {
            $output->writeln("<error>Directory \"$path\" not found.</error>");

            return static::FAILURE;
        }

        copy($this->presetPath($version), $path . '/pint.json');

        $output->writeln("<info>Preset \"$version\" published successfully.</info>");

        return static::SUCCESS;
    }

    protected function validateVersion(string $version): bool
    {
        return file_exists(
            $this->presetPath($version)
        );
    }

    protected function validateDirectory(string $path): bool
    {
        return file_exists($path) && is_dir($path);
    }

    protected function presetPath(string $version): string
    {
        return __DIR__ . "/../../presets/pint/$version.json";
    }
}
