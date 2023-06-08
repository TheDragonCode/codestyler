<?php

declare(strict_types=1);

use PhpCsFixerCustomFixers\Fixer\DeclareAfterOpeningTagFixer;
use PhpCsFixerCustomFixers\Fixer\NoUselessStrlenFixer;
use PhpCsFixerCustomFixers\Fixer\PhpUnitAssertArgumentsOrderFixer;
use PhpCsFixerCustomFixers\Fixer\PhpUnitDedicatedAssertFixer;

return [
    '@PHP70Migration:risky' => true,
    '@PHP71Migration:risky' => true,
    '@PHP74Migration:risky' => true,
    '@PHP80Migration:risky' => true,
    '@PER:risky'            => true,
    '@Symfony:risky'        => true,

    'ordered_traits'        => true,
    'date_time_immutable'   => true,
    'mb_str_functions'      => true,
    'regular_callable_call' => true,

    'phpdoc_to_param_type' => [
        'scalar_types' => true,
    ],

    'phpdoc_to_property_type' => [
        'scalar_types' => true,
    ],

    'phpdoc_to_return_type' => [
        'scalar_types' => true,
    ],

    DeclareAfterOpeningTagFixer::name()      => true,
    NoUselessStrlenFixer::name()             => true,
    PhpUnitAssertArgumentsOrderFixer::name() => true,
    PhpUnitDedicatedAssertFixer::name()      => true,
];