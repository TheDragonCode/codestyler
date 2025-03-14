<?php

declare(strict_types=1);

namespace DragonCode\CodeStyler\Factories;

use App\Project;
use ArrayIterator;
use DragonCode\CodeStyler\Enums\PhpVersion;
use DragonCode\CodeStyler\Repositories\ConfigurationJsonRepository;
use PhpCsFixer\Config;
use PhpCsFixer\Console\ConfigurationResolver;
use PhpCsFixer\ToolInfo;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

use function abort_unless;
use function app;
use function count;
use function dirname;
use function implode;
use function in_array;
use function iterator_to_array;
use function md5;
use function microtime;
use function realpath;
use function resolve;
use function sprintf;
use function sys_get_temp_dir;

class ConfigurationResolverFactory
{
    public static function fromIO(InputInterface $input, OutputInterface $output): array
    {
        $path          = static::paths($input);
        $configuration = static::configuration();

        $preset = $configuration->preset();

        abort_unless(in_array($preset, static::presets(), true), 1, 'Preset not found.');

        $resolver = static::resolver($input, $output, $path, $configuration, $preset);

        $totalFiles = count(
            new ArrayIterator(
                iterator_to_array(
                    $resolver->getFinder()
                )
            )
        );

        return [$resolver, $totalFiles];
    }

    protected static function resolver(
        InputInterface $input,
        OutputInterface $output,
        array $path,
        ConfigurationJsonRepository $configuration,
        string $preset,
    ): ConfigurationResolver {
        return new ConfigurationResolver(
            new Config('default'),
            [
                'allow-risky' => 'yes',
                'config'      => implode(DIRECTORY_SEPARATOR, [
                    dirname(__DIR__, 2),
                    'resources',
                    'presets',
                    sprintf('%s.php', $preset),
                ]),

                'diff'      => $output->isVerbose(),
                'dry-run'   => $input->getOption('test'),
                'path'      => $path,
                'path-mode' => ConfigurationResolver::PATH_MODE_OVERRIDE,

                'cache-file' => $configuration->cacheFile() ?? implode(DIRECTORY_SEPARATOR, [
                    realpath(sys_get_temp_dir()),
                    md5(
                        app()->isProduction()
                            ? implode('|', $path)
                            : microtime()
                    ),
                ]),

                'stop-on-violation' => false,
                'verbosity'         => $output->getVerbosity(),
                'show-progress'     => 'true',
            ],
            Project::path(),
            new ToolInfo()
        );
    }

    protected static function paths(InputInterface $input): array
    {
        return Project::paths($input);
    }

    protected static function configuration(): ConfigurationJsonRepository
    {
        return resolve(ConfigurationJsonRepository::class);
    }

    protected static function presets(): array
    {
        return PhpVersion::values();
    }
}
