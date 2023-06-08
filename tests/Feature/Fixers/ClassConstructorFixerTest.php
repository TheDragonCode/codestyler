<?php

it('fixes the code', function () {
    [$statusCode, $output] = run('default', [
        'path' => base_path('tests/Fixtures/fixers/class_constructor.php'),
    ]);

    expect($statusCode)->toBe(1)
        ->and($output)
        ->toContain('  ⨯')
        ->toContain(
            <<<'EOF'
                  -        protected  int       $bar,
                  -   private bool     $baz
                  -    ) {
                  -    }
                  +        protected int $bar,
                  +        private bool $baz
                  +    ) {}
                EOF,
        );
});
