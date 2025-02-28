<?php

declare(strict_types=1);

it('fixes the code', function () {
    [$statusCode, $output] = run('default', [
        'path' => base_path('tests/Fixtures/fixers/blank_line_before_statement.php'),
    ]);

    expect($statusCode)->toBe(1)
        ->and($output)
        ->toContain('  ⨯')
        ->toContain(
            <<<'EOF'
                  -
                       use Optionable;
                  -
                       use ConfirmableTrait;
                  -
                       use Isolatable;
                EOF,
        );
});

it('fixes the risky code', function () {
    [$statusCode, $output] = run('default', [
        'path'    => base_path('tests/Fixtures/fixers/blank_line_before_statement.php'),
        '--risky' => true,
    ]);

    expect($statusCode)->toBe(1)
        ->and($output)
        ->toContain('  ⨯')
        ->toContain(
            <<<'EOF'
                  -
                  -    use Optionable;
                  -
                       use ConfirmableTrait;
                  -
                       use Isolatable;
                  +    use Optionable;
                EOF,
        )
        ->toContain(
            <<<'EOF'
                       public const FOO = 'foo';
                  -
                       public const BAR = 'bar';
                  -
                       public const BAQ = 'baq';
                EOF,
        )
        ->toContain(
            <<<'EOF'
                  -    case Clubs  =   'C';
                  -
                  -    case Diamonds =   'D';
                  -
                  -    case Hearts  =   'H';
                  -
                  -    case Spades    =   'S';
                  +    case Clubs    = 'C';
                  +    case Diamonds = 'D';
                  +    case Hearts   = 'H';
                  +    case Spades   = 'S';
                EOF,
        )
        ->toContain(
            <<<'EOF'
                       protected const FOO1 = 1;
                  -
                       protected const FOO2 = 1;
                  -
                       protected const FOO3 = 1;
                   
                       public float $prop1;
                EOF,
        );
});
