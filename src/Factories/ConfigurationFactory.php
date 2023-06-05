<?php

declare(strict_types=1);

namespace DragonCode\CodeStyler\Factories;

use App\Factories\ConfigurationFactory as BaseConfigurationFactory;
use App\Fixers\LaravelPhpdocAlignmentFixer;
use DragonCode\CodeStyler\Fixers\ExtraWhitespacesInSingleLineAnonymousFunction;
use DragonCode\CodeStyler\Repositories\ConfigurationRulesRepository;
use PhpCsFixer\Config;
use PhpCsFixer\ConfigInterface;

class ConfigurationFactory extends BaseConfigurationFactory
{
    protected static $notName = [
        '_ide_helper*.php',
        '_ide_helper.php',
        '.phpstorm.meta.php',
        '*.blade.php',
    ];

    public static function preset($rules): ConfigInterface
    {
        return (new Config())
            ->setFinder(self::finder())
            ->setRules(array_merge($rules, resolve(ConfigurationRulesRepository::class)->rules()))
            ->setRiskyAllowed(true)
            ->setUsingCache(true)
            ->registerCustomFixers([
                // Laravel...
                new LaravelPhpdocAlignmentFixer(),
                // Dragon Code...
                new ExtraWhitespacesInSingleLineAnonymousFunction(),
            ]);
    }
}
