<?php

it('fixes the code', function () {
    [$statusCode, $output] = run('default', [
        'path' => base_path('tests/Fixtures/fixers/braces.php'),
    ]);

    expect($statusCode)->toBe(1)
        ->and($output)
        ->toContain('  ⨯')
        ->toContain(
            <<<'EOF'
                  -if (true)
                  -{
                  +if (true) {
                       // ..
                   }
                EOF,
        )
        ->toContain(
            <<<'EOF'
                   try {
                       // ..
                  -} catch (\Exception $e) {
                  +}
                  +catch (\Exception $e) {
                       // ..
                   }
                EOF,
        )
        ->toContain(
            <<<'EOF'
                  -$a = function ()
                  -
                  -{
                  +$a = function () {
                       // ..
                   };
                EOF,
        )
        ->toContain(
            <<<'EOF'
                  -new class ( )
                  -
                  -{
                  +new class {
                       // ..
                   };
                EOF,
        )
        ->toContain(
            <<<'EOF'
                  -new class ( ) extends Bar
                  -{
                  +new class extends Bar {};
                   
                  -}
                EOF,
        )
        ->toContain(
            <<<'EOF'
                  -new class ( ) extends stdClass
                  -
                  +new class extends stdClass
                   {
                       // ..
                   };
                EOF,
        )
        ->toContain(
            <<<'EOF'
                  -new class ( ) extends Foo
                  -
                  +new class extends Foo
                   {
                       protected bool $some = true;
                   };
                EOF,
        )
        ->toContain(
            <<<'EOF'
                  -new class ( ) {
                  +new class {
                       protected bool $value = true;
                   };
                EOF,
        )
        ->toContain(
            <<<'EOF'
                  -class Baq extends Qwerty{
                  +class Baq extends Qwerty
                  +{
                       // ..
                   }
                EOF,
        )
        ->toContain(
            <<<'EOF'
                  -enum Art: int {
                  +enum Art: int
                  +{
                       case FOO = 1;
                EOF,
        );
});
