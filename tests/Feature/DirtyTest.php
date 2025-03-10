<?php

declare(strict_types=1);

use App\Contracts\PathsRepository;

it('determines dirty files', function () {
    $paths = Mockery::mock(PathsRepository::class);

    $paths
        ->shouldReceive('dirty')
        ->once()
        ->andReturn([
            base_path('tests/Fixtures/without-issues/file.php'),
        ]);

    $this->swap(PathsRepository::class, $paths);

    [$statusCode, $output] = run('default', ['--dirty' => true]);

    expect($statusCode)->toBe(0)
        ->and($output)
        ->toContain('── PHP 8.2', ' 1 file');
});

it('ignores the path argument', function () {
    $paths = Mockery::mock(PathsRepository::class);

    $paths
        ->shouldReceive('dirty')
        ->once()
        ->andReturn([
            base_path('tests/Fixtures/without-issues/file.php'),
        ]);

    $this->swap(PathsRepository::class, $paths);

    [$statusCode, $output] = run('default', [
        '--dirty' => true,
        'path'    => base_path(),
    ]);

    expect($statusCode)->toBe(0)
        ->and($output)
        ->toContain('── PHP 8.2', ' 1 file');
});

it('does not abort when there are no dirty files', function () {
    $paths = Mockery::mock(PathsRepository::class);

    $paths
        ->shouldReceive('dirty')
        ->once()
        ->andReturn([]);

    $this->swap(PathsRepository::class, $paths);

    [$statusCode, $output] = run('default', [
        '--dirty' => true,
    ]);

    expect($statusCode)->toBe(0)
        ->and($output)
        ->toContain('── PHP 8.2', ' 0 files');
});
