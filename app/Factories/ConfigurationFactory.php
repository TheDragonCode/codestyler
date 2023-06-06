<?php

declare(strict_types=1);

namespace DragonCode\CodeStyler\Factories;

use App\Factories\ConfigurationFactory as BaseFactory;
use App\Fixers\LaravelPhpdocAlignmentFixer;
use DragonCode\CodeStyler\Fixers\ExtraWhitespacesInSingleLineAnonymousFunction;
use DragonCode\CodeStyler\Repositories\ConfigurationJsonRepository;
use PhpCsFixer\Config;

class ConfigurationFactory extends BaseFactory
{
    public static function preset($rules)
    {
        return (new Config())
            ->setFinder(self::finder())
            ->setRules(array_merge($rules, resolve(ConfigurationJsonRepository::class)->rules()))
            ->setRiskyAllowed(true)
            ->setUsingCache(true)
            ->registerCustomFixers([
                // Laravel...
                new LaravelPhpdocAlignmentFixer(),
                // Dragon...
                new ExtraWhitespacesInSingleLineAnonymousFunction(),
            ]);
    }
}
