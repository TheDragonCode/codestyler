<?php

it('fixes the code', function () {
    [$statusCode, $output] = run('default', [
        'path' => base_path('tests/Fixtures/fixers/parentheses.php'),
    ]);

    expect($statusCode)->toBe(1)
        ->and($output)
        ->toContain('  ⨯')
        ->toContain(
            <<<'EOF'
                  -new class
                  -{
                  +new class {
                       // ..
                   }
                EOF,
        )
        ->toContain(
            <<<'EOF'
                  -new class ( )
                  -{
                  +new class {
                       // ..
                   }
                EOF,
        )
        ->toContain(
            <<<'EOF'
                  -new class ( ) extends Bar
                  +new class extends Bar
                   {
                       protected bool $some = true;
                   };
                EOF,
        )
        ->toContain(
            <<<'EOF'
                  -$x = new X;
                  +$x = new X();
                   $y = new class {};
                EOF,
        )
        ->toContain(
            <<<'EOF'
                   $x = new X();
                  -$y = new class() {};
                  +$y = new class {};
                EOF,
        )
        ->not()
        ->toContain(
            <<<'EOF'
                  -new class extends Foo
                  -{
                  +new class extends Foo
                EOF,
        )
        ->not()
        ->toContain(
            <<<'EOF'
                  +new class () extends Foo
                EOF,
        );
});
