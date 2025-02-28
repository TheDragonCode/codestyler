<?php

declare(strict_types=1);

it('uses the laravel preset by default', function () {
    [$statusCode, $output] = run('default', [
        'path' => base_path('tests/Fixtures/without-issues'),
    ]);

    expect($statusCode)->toBe(0)
        ->and($output)
        ->toContain('── PHP 8.2')
        ->not()
        ->toContain('── PHP 8.2 with risky');
});

it('may use the PHP 8.2 risky', function () {
    [$statusCode, $output] = run('default', [
        'path'    => base_path('tests/Fixtures/without-issues-risky'),
        '--risky' => true,
    ]);

    expect($statusCode)->toBe(0)
        ->and($output)
        ->toContain('── PHP 8.2 with risky');
});
