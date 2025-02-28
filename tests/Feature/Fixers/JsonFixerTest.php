<?php

declare(strict_types=1);

it('fixes the code', function () {
    [$statusCode, $output] = run('default', [
        'path' => base_path('tests/Fixtures/fixers/file.json'),
    ]);

    expect($statusCode)->toBe(1)
        ->and($output)
        ->toContain('FAIL')
        ->toContain('  ⨯')
        ->toContain(
            <<<'EOF'
                   {
                  -    "preset": "psr12", 
                  +    "preset": "psr12",
                       "rules": {
                  -        "no_alias_language_construct_call": true,        "whitespace_after_comma_in_array": {            "ensure_single_space": true        },
                  +        "no_alias_language_construct_call": true,
                  +        "whitespace_after_comma_in_array": {
                  +            "ensure_single_space": true
                  +        },
                           "curly_braces_position": {
                  -            "anonymous_classes_opening_brace": "next_line_unless_newline_at_signature_end"        },
                  -        "class_attributes_separation": {            "elements": {
                  +            "anonymous_classes_opening_brace": "next_line_unless_newline_at_signature_end"
                  +        },
                  +        "class_attributes_separation": {
                  +            "elements": {
                                   "property": "one",
                  -"const": "only_if_meta",                "method": "one",                "case": "none",                "trait_import": "none"
                  +                "const": "only_if_meta",
                  +                "method": "one",
                  +                "case": "none",
                  +                "trait_import": "none"
                               }
                           },
                  -        "@Symfony" : true
                  -    },   "exclude"
                  -: [
                  -    "tests/Fixtures",    "tests/fixtures"]
                  +        "@Symfony": true
                  +    },
                  +    "exclude": [
                  +        "tests/Fixtures",
                  +        "tests/fixtures"
                  +    ]
                   }
                EOF,
        );
});

it('fixes the risky code', function () {
    [$statusCode, $output] = run('default', [
        'path'    => base_path('tests/Fixtures/fixers/file.json'),
        '--risky' => true,
    ]);

    expect($statusCode)->toBe(1)
        ->and($output)
        ->toContain('FAIL')
        ->toContain('  ⨯')
        ->toContain(
            <<<'EOF'
                  {
                  -    "preset": "psr12", 
                  +    "exclude": [
                  +        "tests/Fixtures",
                  +        "tests/fixtures"
                  +    ],
                  +    "preset": "psr12",
                       "rules": {
                  -        "no_alias_language_construct_call": true,        "whitespace_after_comma_in_array": {            "ensure_single_space": true        },
                  -        "curly_braces_position": {
                  -            "anonymous_classes_opening_brace": "next_line_unless_newline_at_signature_end"        },
                  -        "class_attributes_separation": {            "elements": {
                  +        "@Symfony": true,
                  +        "class_attributes_separation": {
                  +            "elements": {
                  +                "case": "none",
                  +                "const": "only_if_meta",
                  +                "method": "one",
                                   "property": "one",
                  -"const": "only_if_meta",                "method": "one",                "case": "none",                "trait_import": "none"
                  +                "trait_import": "none"
                               }
                           },
                  -        "@Symfony" : true
                  -    },   "exclude"
                  -: [
                  -    "tests/Fixtures",    "tests/fixtures"]
                  +        "curly_braces_position": {
                  +            "anonymous_classes_opening_brace": "next_line_unless_newline_at_signature_end"
                  +        },
                  +        "no_alias_language_construct_call": true,
                  +        "whitespace_after_comma_in_array": {
                  +            "ensure_single_space": true
                  +        }
                  +    }
                   }
                EOF,
        );
});
