<?php

declare(strict_types=1);

use PhpCsFixer\Config;
use PhpCsFixer\Finder;

$finder = Finder::create()
    ->exclude([
        '.git',
        '.github',
        '.idea',
        'node_modules',
        'storage',
        'vendor',
    ])
    ->in('.');

return (new Config())
    ->setFinder($finder)
    ->setUsingCache(false)
    ->setRiskyAllowed(true)
    ->setRules([
        '@PSR12'              => true,
        '@PHP73Migration'     => true,
        '@PHP74Migration'     => true,
        '@PHP80Migration'     => true,
        '@PHP81Migration'     => true,
        '@DoctrineAnnotation' => true,

        'no_alias_language_construct_call' => true,

        'no_mixed_echo_print' => [
            'use' => 'echo',
        ],

        'array_syntax' => [
            'syntax' => 'short',
        ],

        'no_multiline_whitespace_around_double_arrow' => true,
        'no_trailing_comma_in_singleline_array'       => true,

        'no_whitespace_before_comma_in_array' => [
            'after_heredoc' => false,
        ],

        'normalize_index_brace'           => true,
        'trim_array_spaces'               => true,
        'whitespace_after_comma_in_array' => true,

        'braces' => [
            'allow_single_line_anonymous_class_with_empty_body' => true,
            'allow_single_line_closure'                         => true,
        ],

        'class_reference_name_casing' => true,
        'integer_literal_case'        => true,

        'magic_constant_casing' => true,
        'magic_method_casing'   => true,

        'native_function_casing'                  => true,
        'native_function_type_declaration_casing' => true,

        'cast_spaces' => [
            'space' => 'single',
        ],

        'no_short_bool_cast' => true,
        'no_unset_cast'      => true,

        'class_attributes_separation' => [
            'elements' => [
                'property'     => 'one',
                'const'        => 'one',
                'method'       => 'one',
                'trait_import' => 'none',
            ],
        ],

        'class_definition' => [
            'single_line'              => true,
            'space_before_parenthesis' => true,
        ],

        'final_internal_class'            => false,
        'no_null_property_initialization' => true,

        'ordered_class_elements' => [
            'order' => [
                'use_trait',

                'public',
                'protected',
                'private',

                'constant',
                'property_static',
                'property',

                'method_abstract',

                'phpunit',

                'construct',
                'destruct',
                'magic',

                'method_static',
                'method',
            ],
        ],

        'protected_to_private' => false,
        'self_static_accessor' => true,

        'single_class_element_per_statement' => [
            'elements' => ['const', 'property'],
        ],

        'multiline_comment_opening_closing' => true,

        'no_empty_comment' => true,

        'single_line_comment_style' => [
            'comment_types' => ['asterisk'],
        ],

        'control_structure_continuation_position' => [
            'position' => 'same_line',
        ],

        'empty_loop_body' => [
            'style' => 'braces',
        ],

        'empty_loop_condition' => [
            'style' => 'while',
        ],

        'include' => true,

        'no_alternative_syntax' => [
            'fix_non_monolithic_code' => true,
        ],

        'no_superfluous_elseif'          => true,
        'no_trailing_comma_in_list_call' => true,

        'no_unneeded_control_parentheses' => [
            'statements' => ['break', 'clone', 'continue', 'echo_print', 'return', 'switch_case', 'yield', 'yield_from'],
        ],

        'no_unneeded_curly_braces' => [
            'namespaces' => false,
        ],

        'no_useless_else'      => true,
        'simplified_if_return' => true,

        'switch_continue_to_break' => true,

        'trailing_comma_in_multiline' => [
            'after_heredoc' => false,
            'elements'      => ['arrays'],
        ],

        'yoda_style' => [
            'equal'                => false,
            'identical'            => false,
            'less_and_greater'     => false,
            'always_move_variable' => true,
        ],

        'function_typehint_space' => true,
        'lambda_not_used_import'  => true,

        'method_argument_space' => [
            'on_multiline' => 'ignore',
        ],

        'nullable_type_declaration_for_default_null_value' => [
            'use_nullable_type_declaration' => true,
        ],

        'single_line_throw' => true,

        'fully_qualified_strict_types' => true,

        'global_namespace_import' => [
            'import_constants' => false,
            'import_functions' => true,
            'import_classes'   => true,
        ],

        'no_unneeded_import_alias' => true,
        'no_unused_imports'        => true,

        'ordered_imports' => [
            'sort_algorithm' => 'alpha',
            'imports_order'  => ['class', 'function', 'const'],
        ],

        'combine_consecutive_issets' => true,
        'combine_consecutive_unsets' => true,

        'declare_parentheses' => true,

        'explicit_indirect_variable' => true,

        'single_space_after_construct' => [
            'constructs' => [
                'abstract',
                'as',
                'attribute',
                'break',
                'case',
                'catch',
                'class',
                'clone',
                'comment',
                'const',
                'const_import',
                'continue',
                'do',
                'echo',
                'else',
                'elseif',
                'enum',
                'extends',
                'final',
                'finally',
                'for',
                'foreach',
                'function',
                'function_import',
                'global',
                'goto',
                'if',
                'implements',
                'include',
                'include_once',
                'instanceof',
                'insteadof',
                'interface',
                'match',
                'named_argument',
                'namespace',
                'new',
                'open_tag_with_echo',
                'php_doc',
                'php_open',
                'print',
                'private',
                'protected',
                'public',
                'readonly',
                'require',
                'require_once',
                'return',
                'static',
                'switch',
                'throw',
                'trait',
                'try',
                'use',
                'use_lambda',
                'use_trait',
                'var',
                'while',
                'yield',
                'yield_from',
            ],
        ],

        'list_syntax' => [
            'syntax' => 'short',
        ],

        'clean_namespace' => true,

        'no_leading_namespace_whitespace' => true,

        'assign_null_coalescing_to_coalesce_equal' => true,

        'binary_operator_spaces' => [
            'default' => 'align_single_space',
        ],

        'concat_space' => [
            'spacing' => 'one',
        ],

        'increment_style' => [
            'style' => 'pre',
        ],

        'not_operator_with_successor_space'  => true,
        'object_operator_without_whitespace' => true,

        'operator_linebreak' => [
            'only_booleans' => false,
            'position'      => 'beginning',
        ],

        'standardize_increment'  => true,
        'standardize_not_equals' => true,
        'unary_operator_spaces'  => true,

        'echo_tag_syntax' => [
            'format'        => 'long',
            'long_function' => 'echo',

            'shorten_simple_statements_only' => true,
        ],

        'linebreak_after_opening_tag' => true,
        'php_unit_fqcn_annotation'    => true,

        'php_unit_method_casing' => [
            'case' => 'camel_case',
        ],

        'align_multiline_comment' => true,

        'general_phpdoc_tag_rename' => [
            'replacements' => [
                'inheritDocs' => 'inheritDoc',
            ],
        ],

        'no_blank_lines_after_phpdoc' => true,
        'no_empty_phpdoc'             => true,

        'phpdoc_add_missing_param_annotation' => [
            'only_untyped' => false,
        ],

        'phpdoc_align' => [
            'tags'  => [
                'var',
                'param',
                'property',
                'property-read',
                'property-write',
                'method',
                'throws',
                'return',
            ],
            'align' => 'left',
        ],

        'phpdoc_annotation_without_dot' => true,

        'phpdoc_indent' => true,

        'phpdoc_inline_tag_normalizer' => [
            'tags' => [
                'example',
                'id',
                'internal',
                'inheritdoc',
                'inheritdocs',
                'link',
                'source',
                'toc',
                'tutorial',
            ],
        ],

        'phpdoc_line_span' => [
            'const'    => 'single',
            'property' => 'single',
            'method'   => 'multi',
        ],

        'phpdoc_no_access' => true,

        'phpdoc_no_alias_tag' => [
            'replacements' => [
                'property-read'  => 'property',
                'property-write' => 'property',
                'type'           => 'var',
                'link'           => 'see',
            ],
        ],

        'phpdoc_no_package' => true,

        'phpdoc_no_useless_inheritdoc' => true,

        'phpdoc_order' => true,

        'phpdoc_return_self_reference' => [
            'replacements' => [
                'this'    => '$this',
                '@this'   => '$this',
                '$self'   => 'self',
                '@self'   => 'self',
                '$static' => 'static',
                '@static' => 'static',
            ],
        ],

        'phpdoc_scalar' => [
            'types' => ['boolean', 'callback', 'double', 'integer', 'real', 'str'],
        ],

        'phpdoc_separation' => true,

        'phpdoc_single_line_var_spacing' => true,

        'phpdoc_summary' => true,

        'phpdoc_tag_type' => [
            'tags' => ['inheritDoc' => 'inline'],
        ],

        'phpdoc_to_comment' => [
            'ignored_tags' => [],
        ],

        'phpdoc_trim_consecutive_blank_line_separation' => true,

        'phpdoc_trim' => true,

        'phpdoc_types' => [
            'groups' => ['simple', 'alias', 'meta'],
        ],

        'phpdoc_types_order' => [
            'null_adjustment' => 'always_last',
            'sort_algorithm'  => 'none',
        ],

        'phpdoc_var_annotation_correct_order' => true,

        'phpdoc_var_without_name' => true,

        'no_useless_return' => true,
        'return_assignment' => true,

        'multiline_whitespace_before_semicolons' => [
            'strategy' => 'no_multi_line',
        ],

        'no_empty_statement' => true,

        'no_singleline_whitespace_before_semicolons' => true,

        'semicolon_after_instruction' => true,

        'space_after_semicolon' => [
            'remove_in_empty_for_expressions' => true,
        ],

        'escape_implicit_backslashes' => [
            'single_quoted'  => false,
            'double_quoted'  => true,
            'heredoc_syntax' => true,
        ],

        'heredoc_to_nowdoc' => true,

        'no_binary_string' => true,

        'simple_to_complex_string_variable' => true,

        'single_quote' => [
            'strings_containing_single_quote_chars' => false,
        ],

        'array_indentation' => true,

        'blank_line_before_statement' => [
            'statements' => ['return', 'continue', 'try', 'do', 'if', 'exit', 'goto', 'switch', 'case', 'default', 'throw', 'yield'],
        ],

        'method_chaining_indentation' => true,

        'no_extra_blank_lines' => [
            'tokens' => [
                'case',
                'continue',
                'curly_brace_block',
                'default',
                'extra',
                'parenthesis_brace_block',
                'square_brace_block',
                'switch',
                'throw',
                'use',
                'return',
            ],
        ],

        'no_spaces_around_offset' => [
            'positions' => ['inside', 'outside'],
        ],

        'types_spaces' => [
            'space' => 'none',
        ],
    ]);
