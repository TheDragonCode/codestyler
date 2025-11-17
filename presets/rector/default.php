<?php

declare(strict_types=1);

use Rector\Config\RectorConfig;
use RectorLaravel\Rector\FuncCall\RemoveDumpDataDeadCodeRector;

$paths = static fn (array $paths): array => array_filter($paths, fn (string $path): bool => realpath($path) !== false);

return RectorConfig::configure()
    ->withPaths(
        $paths([
            'app',
            'config',
            'database',
            'public/index.php',
            'resources',
            'src',
            'tests',
        ])
    )
    ->withFileExtensions(['php'])
    ->withParallel()
    ->withPreparedSets(
        deadCode        : true,
        typeDeclarations: true,
    )
    ->withPhpSets()
    ->withImportNames(
        removeUnusedImports: true,
    )
    ->withComposerBased(
        phpunit: true
    )
    ->withAttributesSets(
        phpunit: true,
    )
    ->withConfiguredRule(RemoveDumpDataDeadCodeRector::class, [
        'dd',
        'dump',
        'var_dump',
        'print_r',
        'echo',
    ]);
