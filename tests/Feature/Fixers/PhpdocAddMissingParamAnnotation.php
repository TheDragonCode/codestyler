<?php

it('fixes the code', function () {
    [$statusCode, $output] = run('default', [
        'path' => base_path('tests/Fixtures/fixers/phpdoc_add_missing_param_annotation.php'),
    ]);

    expect($statusCode)->toBe(1)
        ->and($output)
        ->toContain('  ⨯')
        ->toContain('FAIL', '1 file')
        ->toContain(
            <<<'EOF'
                   {
                       /**
                        * Some instance.
                  +     *
                  +     * @param  Throwable|null  $bar
                        */
                       public function __construct(
                           public ?Throwable $foo = null
                           public readonly ?Throwable $bar = null
                       }
                EOF,
        );
});
