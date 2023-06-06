<?php

declare(strict_types=1);

namespace Factories;

use DragonCode\CodeStyler\Project;
use DragonCode\CodeStyler\Repositories\ConfigurationRepository;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ConfigurationResolverFactory
{
    /**
     * The list of available presets.
     *
     * @var array<string>
     */
    public static $presets = [
        'dragon-code',
    ];

    public static function fromIO(InputInterface $input, OutputInterface $output)
    {
        $path = Project::paths($input);

        $localConfiguration = resolve(ConfigurationRepository::class);
        
        $preset = $localConfiguration->preset();
    }
}
