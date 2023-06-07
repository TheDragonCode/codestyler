<?php

declare(strict_types=1);

namespace DragonCode\CodeStyler\Factories;

use ArrayIterator;
use DragonCode\CodeStyler\Project;
use DragonCode\CodeStyler\Repositories\ConfigurationJsonRepository;
use PhpCsFixer\Config;
use PhpCsFixer\Console\ConfigurationResolver;
use PhpCsFixer\ToolInfo;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ConfigurationResolverFactory
{
    public static array $presets = [
        '8.1',
        '8.1-risky',
        '8.2',
        '8.2-risky',
    ];

    public static function fromIO(InputInterface $input, OutputInterface $output): array
    {
        $path          = static::paths($input);
        $configuration = static::configuration();

        $preset = $configuration->preset();

        abort_unless(in_array($preset, static::$presets), 1, 'Preset not found.');

        $resolver = static::resolver($input, $output, $path, $configuration, $preset);

        $totalFiles = count(new ArrayIterator(iterator_to_array(
            $resolver->getFinder()
        )));

        return [$resolver, $totalFiles];
    }

    protected static function resolver(
        InputInterface $input,
        OutputInterface $output,
        array $path,
        ConfigurationJsonRepository $configuration,
        string $preset
    ) {
        return new ConfigurationResolver(
            new Config('default'),
            [
                'allow-risky' => static::allowRisky($input) ? 'yes' : 'no',
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
                            : (string) microtime()
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

    protected static function configuration()
    {
        return resolve(ConfigurationJsonRepository::class);
    }

    protected static function allowRisky(InputInterface $input): bool
    {
        return $input->getOption('risky');
    }
}
