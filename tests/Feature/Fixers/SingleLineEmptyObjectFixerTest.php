<?php

it('fixes the code', function () {
    [$statusCode, $output] = run('default', [
        'path' => base_path('tests/Fixtures/fixers/single_line_empty_object.php'),
    ]);

    expect($statusCode)->toBe(1)
        ->and($output)
        ->toContain('  ⨯')
        ->toContain(
            <<<'EOF'
                  -new class () extends BaseChangeColumn
                  -{
                  -};
                  +new class extends BaseChangeColumn {};
                EOF,
        )
        ->toContain(
            <<<'EOF'
                  -    ) {
                  -    }
                  +    ) {}
                EOF,
        )
        ->toContain(
            <<<'EOF'
                  -function success(): void
                  -{
                  -}
                  +function success(): void {}
                EOF,
        )
        ->toContain(
            <<<'EOF'
                  -    public function internal()
                  -    {
                  -    }
                  +    public function internal() {}
                EOF
        )
        ->not()
        ->toContain(
            <<<'EOF'
                  -enum a: int
                  -{
                  -}
                  +enum a: int {}
                EOF
        );
});
