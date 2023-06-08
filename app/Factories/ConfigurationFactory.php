<?php

declare(strict_types=1);

namespace DragonCode\CodeStyler\Factories;

use App\Factories\ConfigurationFactory as BaseFactory;
use App\Fixers\LaravelPhpdocAlignmentFixer;
use DragonCode\CodeStyler\Fixers\JsonFixer;
use DragonCode\CodeStyler\Fixers\JsonRiskyFixer;
use DragonCode\CodeStyler\Repositories\ConfigurationJsonRepository;
use PedroTroller\CS\Fixer\DeadCode\UselessCodeAfterReturnFixer;
use PhpCsFixer\Config;
use PhpCsFixer\ConfigInterface;
use PhpCsFixer\Finder;
use PhpCsFixerCustomFixers\Fixer\DeclareAfterOpeningTagFixer;
use PhpCsFixerCustomFixers\Fixer\MultilineCommentOpeningClosingAloneFixer;
use PhpCsFixerCustomFixers\Fixer\MultilinePromotedPropertiesFixer;
use PhpCsFixerCustomFixers\Fixer\NoDuplicatedImportsFixer;
use PhpCsFixerCustomFixers\Fixer\NoPhpStormGeneratedCommentFixer;
use PhpCsFixerCustomFixers\Fixer\NoSuperfluousConcatenationFixer;
use PhpCsFixerCustomFixers\Fixer\NoUselessDoctrineRepositoryCommentFixer;
use PhpCsFixerCustomFixers\Fixer\NoUselessParenthesisFixer;
use PhpCsFixerCustomFixers\Fixer\NoUselessStrlenFixer;
use PhpCsFixerCustomFixers\Fixer\PhpdocArrayStyleFixer;
use PhpCsFixerCustomFixers\Fixer\PhpdocNoIncorrectVarAnnotationFixer;
use PhpCsFixerCustomFixers\Fixer\PhpUnitAssertArgumentsOrderFixer;
use PhpCsFixerCustomFixers\Fixer\PhpUnitDedicatedAssertFixer;
use PhpCsFixerCustomFixers\Fixer\SingleSpaceAfterStatementFixer;
use PhpCsFixerCustomFixers\Fixer\SingleSpaceBeforeStatementFixer;

class ConfigurationFactory extends BaseFactory
{
    protected static array $names = [
        '/\.json$/',
    ];

    protected static $notName = [
        '_ide_helper_actions.php',
        '_ide_helper_models.php',
        '_ide_helper.php',
        '.phpstorm.meta.php',
        '*.blade.php',
        'composer.json',
        'package.json',
        'package-lock.json',
    ];

    public static function preset($rules): ConfigInterface
    {
        return (new Config())
            ->setFinder(self::finder())
            ->setRules(array_merge($rules, resolve(ConfigurationJsonRepository::class)->rules()))
            ->setRiskyAllowed(true)
            ->setUsingCache(true)
            ->registerCustomFixers([
                // Dragon
                new JsonFixer(),
                new JsonRiskyFixer(),
                // Laravel...
                new LaravelPhpdocAlignmentFixer(),
                // PhpCsFixerCustomFixers...
                new DeclareAfterOpeningTagFixer(),
                new MultilineCommentOpeningClosingAloneFixer(),
                new MultilinePromotedPropertiesFixer(),
                new NoDuplicatedImportsFixer(),
                new NoPhpStormGeneratedCommentFixer(),
                new NoSuperfluousConcatenationFixer(),
                new NoUselessDoctrineRepositoryCommentFixer(),
                new NoUselessParenthesisFixer(),
                new NoUselessStrlenFixer(),
                new PhpUnitAssertArgumentsOrderFixer(),
                new PhpUnitDedicatedAssertFixer(),
                new PhpdocArrayStyleFixer(),
                new PhpdocNoIncorrectVarAnnotationFixer(),
                new SingleSpaceAfterStatementFixer(),
                new SingleSpaceBeforeStatementFixer(),
                // PedroTroller...
                new UselessCodeAfterReturnFixer(),
            ]);
    }

    public static function finder(): Finder
    {
        return parent::finder()->name(static::$names);
    }
}
