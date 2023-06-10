<?php

declare(strict_types=1);

use App\Fixers\LaravelPhpdocAlignmentFixer;
use DragonCode\CodeStyler\Fixers\JsonFixer;
use DragonCode\CodeStyler\Fixers\XmlFixer;
use DragonCode\CodeStyler\Fixers\YamlFixer;
use PedroTroller\CS\Fixer\DeadCode\UselessCodeAfterReturnFixer;
use PhpCsFixerCustomFixers\Fixer\MultilineCommentOpeningClosingAloneFixer;
use PhpCsFixerCustomFixers\Fixer\MultilinePromotedPropertiesFixer;
use PhpCsFixerCustomFixers\Fixer\NoDuplicatedImportsFixer;
use PhpCsFixerCustomFixers\Fixer\NoPhpStormGeneratedCommentFixer;
use PhpCsFixerCustomFixers\Fixer\NoSuperfluousConcatenationFixer;
use PhpCsFixerCustomFixers\Fixer\NoUselessDoctrineRepositoryCommentFixer;
use PhpCsFixerCustomFixers\Fixer\NoUselessParenthesisFixer;
use PhpCsFixerCustomFixers\Fixer\PhpdocArrayStyleFixer;
use PhpCsFixerCustomFixers\Fixer\PhpdocNoIncorrectVarAnnotationFixer;
use PhpCsFixerCustomFixers\Fixer\SingleSpaceAfterStatementFixer;
use PhpCsFixerCustomFixers\Fixer\SingleSpaceBeforeStatementFixer;

return [
    '@DoctrineAnnotation' => true,
    '@PHP70Migration'     => true,
    '@PHP71Migration'     => true,
    '@PHP73Migration'     => true,
    '@PHP74Migration'     => true,
    '@PHP80Migration'     => true,
    '@PHP81Migration'     => true,
    '@PER'                => true,
    '@Symfony'            => true,

    'array_indentation' => true,

    'binary_operator_spaces' => [
        'default' => 'align_single_space_minimal',
    ],

    'blank_line_before_statement' => [
        'statements' => [
            'continue',
            'declare',
            'default',
            'do',
            'exit',
            'for',
            'foreach',
            'goto',
            'if',
            'include',
            'include_once',
            'phpdoc',
            'require',
            'require_once',
            'return',
            'switch',
            'throw',
            'try',
            'while',
            'yield',
            'yield_from',
        ],
    ],

    'class_attributes_separation' => [
        'elements' => [
            'case'         => 'none',
            'const'        => 'none',
            'method'       => 'one',
            'property'     => 'one',
            'trait_import' => 'none',
        ],
    ],

    'class_definition' => [
        'inline_constructor_arguments'        => true,
        'multi_line_extends_each_single_line' => true,
        'single_item_single_line'             => true,
        'single_line'                         => true,
        'space_before_parenthesis'            => true,
    ],

    'combine_consecutive_issets' => true,
    'combine_consecutive_unsets' => true,

    'concat_space' => [
        'spacing' => 'one',
    ],

    'control_structure_braces' => true,

    'control_structure_continuation_position' => [
        'position' => 'next_line',
    ],

    'curly_braces_position' => [
        'allow_single_line_anonymous_functions'     => true,
        'allow_single_line_empty_anonymous_classes' => true,
        'anonymous_classes_opening_brace'           => 'same_line',
    ],

    'declare_parentheses' => true,

    'escape_implicit_backslashes' => [
        'double_quoted'  => true,
        'heredoc_syntax' => true,
        'single_quoted'  => false,
    ],

    'explicit_indirect_variable' => true,

    'global_namespace_import' => [
        'import_classes' => true,
    ],

    'heredoc_to_nowdoc'                 => true,
    'method_chaining_indentation'       => true,
    'multiline_comment_opening_closing' => true,

    'multiline_whitespace_before_semicolons' => [
        'strategy' => 'no_multi_line',
    ],

    'new_with_braces' => [
        'anonymous_class' => false,
    ],

    'no_extra_blank_lines' => [
        'tokens' => [
            'attribute',
            'break',
            // 'case',
            'continue',
            'curly_brace_block',
            'default',
            'extra',
            'parenthesis_brace_block',
            'return',
            'square_brace_block',
            'switch',
            'throw',
            'use',
            'use_trait',
        ],
    ],

    'no_superfluous_elseif'             => true,
    'no_useless_else'                   => true,
    'no_useless_return'                 => true,
    'not_operator_with_successor_space' => true,

    'nullable_type_declaration_for_default_null_value' => [
        'use_nullable_type_declaration' => true,
    ],

    'operator_linebreak' => [
        'only_booleans' => false,
    ],

    'ordered_class_elements' => [
        'order' => [
            'use_trait',
            'case',
            'public',
            'protected',
            'private',
            'constant',
            'property',
            'property_static',
            'phpunit',
            'method_abstract',
            'construct',
            'method',
            'method_static',
            'destruct',
        ],
    ],

    'ordered_imports' => [
        'imports_order' => [
            'class',
            'const',
            'function',
        ],
    ],

    'ordered_interfaces' => [
        'direction' => 'ascend',
        'order'     => 'alpha',
    ],

    'ordered_types' => [
        'null_adjustment' => 'always_last',
        'sort_algorithm'  => 'alpha',
    ],

    'phpdoc_add_missing_param_annotation' => [
        'only_untyped' => false,
    ],

    'phpdoc_align' => [
        'align' => 'left',
        'tags'  => [
            'throws',
            'return',
        ],
    ],

    'phpdoc_line_span' => [
        'const'    => 'single',
        'method'   => 'multi',
        'property' => 'single',
    ],

    'phpdoc_order' => [
        'order' => [
            'param',
            'throws',
            'return',
        ],
    ],

    'phpdoc_var_annotation_correct_order' => true,
    'return_assignment'                   => true,
    'self_static_accessor'                => true,
    'simplified_if_return'                => true,
    'simplified_null_return'              => true,

    'single_line_comment_style' => [
        'comment_types' => [
            'asterisk',
            'hash',
        ],
    ],

    'single_line_empty_body' => true,

    'types_spaces' => [
        'space_multiple_catch' => 'none',
    ],

    'whitespace_after_comma_in_array' => [
        'ensure_single_space' => true,
    ],

    'yoda_style' => [
        'always_move_variable' => true,
        'equal'                => false,
        'identical'            => false,
        'less_and_greater'     => false,
    ],

    'phpdoc_param_order' => true,

    (new JsonFixer())->getName() => true,
    (new YamlFixer())->getName() => true,
    // (new XmlFixer())->getName()  => true,

    (new LaravelPhpdocAlignmentFixer())->getName() => true,

    (new UselessCodeAfterReturnFixer())->getName() => true,

    MultilineCommentOpeningClosingAloneFixer::name() => true,
    NoDuplicatedImportsFixer::name()                 => true,
    NoPhpStormGeneratedCommentFixer::name()          => true,
    NoSuperfluousConcatenationFixer::name()          => true,
    NoUselessDoctrineRepositoryCommentFixer::name()  => true,
    NoUselessParenthesisFixer::name()                => true,
    SingleSpaceBeforeStatementFixer::name()          => true,
    SingleSpaceAfterStatementFixer::name()           => true,
    PhpdocArrayStyleFixer::name()                    => true,
    PhpdocNoIncorrectVarAnnotationFixer::name()      => true,

    MultilinePromotedPropertiesFixer::name() => [
        'minimum_number_of_parameters' => 3,
    ],
];
