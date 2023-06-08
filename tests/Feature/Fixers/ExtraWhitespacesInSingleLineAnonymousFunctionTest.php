<?php

it('fixes the code', function () {
    [$statusCode, $output] = run('default', [
        'path' => base_path('tests/Fixtures/fixers/extra_whitespaces_in_single_line_anonymous_function.php'),
    ]);

    expect($statusCode)->toBe(1)
        ->and($output)
        ->toContain('FAIL')
        ->toContain(
            <<<'EOF'
                  -function () {     return 'foo';};
                  +function () { return 'foo'; };
                EOF,
        )
        ->toContain(
            <<<'EOF'
                  -fn   ( )=>   'foo' ;
                  +fn () => 'foo';
                EOF,
        )
        ->toContain(
            <<<'EOF'
                  -$result = function   (    ){return    'foo'   ;     };
                  +$result = function () {return 'foo'; };
                EOF,
        )
        ->toContain(
            <<<'EOF'
                  -$result = fn()   =>    'foo'  ;
                  +$result = fn () => 'foo';
                EOF,
        )
        ->toContain(
            <<<'EOF'
                  -function(  )   use   (   $foo ,  &$bar  ){return    'foo'  ;   };
                  +function () use (&$bar) {return 'foo'; };
                EOF,
        )
        ->toContain(
            <<<'EOF'
                  -fn  (   )   =>    'foo' ;
                  +fn () => 'foo';
                EOF,
        )
        ->toContain(
            <<<'EOF'
                  -$result = function(   )use($foo  )   {  return 'foo'  ;  };
                  +$result = function () { return 'foo'; };
                EOF,
        )
        ->toContain(
            <<<'EOF'
                  -$result =   fn   (  )   =>   'foo'  ;
                  +$result = fn () => 'foo';
                EOF,
        );
});
