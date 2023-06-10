<?php

it('fixes the xml', function () {
    [$statusCode, $output] = run('default', [
        'path' => base_path('tests/Fixtures/fixers/file.xml'),
    ]);

    expect($statusCode)->toBe(1);
});

it('fixes the xml.dist', function () {
    [$statusCode, $output] = run('default', [
        'path' => base_path('tests/Fixtures/fixers/file.xml.dist'),
    ]);

    expect($statusCode)->toBe(1);
});
