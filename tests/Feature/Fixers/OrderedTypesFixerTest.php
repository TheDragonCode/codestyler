<?php

declare(strict_types=1);

it('fixes the code', function () {
    [$statusCode, $output] = run('default', [
        'path' => base_path('tests/Fixtures/fixers/ordered_types.php'),
    ]);

    expect($statusCode)->toBe(1)
        ->and($output)
        ->toContain('  ⨯')
        ->toContain(
            <<<'EOF'
                  -    protected string|array|null $environment = null;
                  +    protected array|string|null $environment = null;
                EOF,
        )
        ->toContain(
            <<<'EOF'
                  -    protected function getIsolateOption(): null|int|bool
                  +    protected function getIsolateOption(): bool|int|null
                EOF,
        )
        ->toContain(
            <<<'EOF'
                  -class Foo implements ShouldQueue, ShouldBeUnique
                  +class Foo implements ShouldBeUnique, ShouldQueue
                EOF,
        )
        ->toContain(
            <<<'EOF'
                  -    protected function castStep(string|null|int $value): ?int
                  +    protected function castStep(int|string|null $value): ?int
                EOF,
        );
});
