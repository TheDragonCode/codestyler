<?php

it('fixes the code', function () {
    [$statusCode, $output] = run('default', [
        'path' => base_path('tests/Fixtures/fixers/laravel_phpdoc_separation.php'),
    ]);

    expect($statusCode)->toBe(1)
        ->and($output)
        ->toContain('  ⨯')
        ->toContain('FAIL', '1 file')
        ->toContain(
            <<<'EOF'
                   /**
                    * @param  string  $foo
                  + * @param  string  $bar
                    *
                  - * @param  string  $bar
                    * @return string
                    */
                EOF,
        );
});
