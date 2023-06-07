<?php

declare(strict_types=1);

namespace DragonCode\CodeStyler\Factories;

use App\Factories\ConfigurationFactory as BaseFactory;
use App\Fixers\LaravelPhpdocAlignmentFixer;
use DragonCode\CodeStyler\Repositories\ConfigurationJsonRepository;
use PedroTroller\CS\Fixer\DeadCode\UselessCodeAfterReturnFixer;
use PhpCsFixer\Config;
use PhpCsFixer\ConfigInterface;
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
    public static function preset($rules): ConfigInterface
    {
        return (new Config())
            ->setFinder(self::finder())
            ->setRules(array_merge($rules, resolve(ConfigurationJsonRepository::class)->rules()))
            ->setRiskyAllowed(true)
            ->setUsingCache(true)
            ->registerCustomFixers([
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
}
