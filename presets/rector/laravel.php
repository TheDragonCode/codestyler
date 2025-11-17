<?php

declare(strict_types=1);

use Rector\Config\RectorConfig;
use RectorLaravel\Rector\Class_\RemoveModelPropertyFromFactoriesRector;
use RectorLaravel\Rector\FuncCall\RemoveDumpDataDeadCodeRector;
use RectorLaravel\Rector\FuncCall\TypeHintTappableCallRector;
use RectorLaravel\Rector\MethodCall\EloquentWhereRelationTypeHintingParameterRector;
use RectorLaravel\Rector\MethodCall\EloquentWhereTypeHintClosureParameterRector;
use RectorLaravel\Rector\MethodCall\UseComponentPropertyWithinCommandsRector;
use RectorLaravel\Rector\MethodCall\WhereToWhereLikeRector;
use RectorLaravel\Set\LaravelSetList;
use RectorLaravel\Set\LaravelSetProvider;

$paths = static fn (array $paths): array => array_filter($paths, fn (string $path): bool => realpath($path) !== false);

return RectorConfig::configure()
    ->withPaths(
        $paths([
            'app',
            'bin',
            'bootstrap',
            'config',
            'database',
            'lang',
            'operations',
            'public/index.php',
            'resources',
            'routes',
            'src',
            'tests',
        ])
    )
    ->withSkip(
        $paths(['bootstrap/cache'])
    )
    ->withFileExtensions(['php'])
    ->withParallel()
    ->withPreparedSets(
        deadCode        : true,
        typeDeclarations: true,
    )
    ->withPhpSets()
    ->withSetProviders(LaravelSetProvider::class)
    ->withImportNames(
        removeUnusedImports: true,
    )
    ->withComposerBased(
        phpunit: true,
        laravel: true
    )
    ->withAttributesSets(
        phpunit: true,
    )
    ->withSets([
        LaravelSetList::LARAVEL_COLLECTION,
        LaravelSetList::LARAVEL_FACADE_ALIASES_TO_FULL_NAMES,
        LaravelSetList::LARAVEL_TESTING,
    ])
    ->withConfiguredRule(RemoveDumpDataDeadCodeRector::class, [
        'dd',
        'dump',
        'var_dump',
        'print_r',
        'echo',
    ])
    ->withConfiguredRule(WhereToWhereLikeRector::class, [
        WhereToWhereLikeRector::USING_POSTGRES_DRIVER => true,
    ])
    ->withRules([
        RemoveModelPropertyFromFactoriesRector::class,
        UseComponentPropertyWithinCommandsRector::class,
        TypeHintTappableCallRector::class,
        EloquentWhereRelationTypeHintingParameterRector::class,
        EloquentWhereTypeHintClosureParameterRector::class,
    ]);
