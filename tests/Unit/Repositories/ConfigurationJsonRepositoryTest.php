<?php

use DragonCode\CodeStyler\Helpers\PhpVersion;
use DragonCode\CodeStyler\Repositories\ConfigurationJsonRepository;

it('works without json file', function () {
    $repository = new ConfigurationJsonRepository(null, null);

    expect($repository->finder())->toBeEmpty()
        ->and($repository->rules())->toBeEmpty();
});

it('may have rules options', function () {
    $repository = new ConfigurationJsonRepository(dirname(__DIR__, 2) . '/Fixtures/rules/pint.json', null);

    expect($repository->rules())->toBe([]);
});

it('may have finder options', function () {
    $repository = new ConfigurationJsonRepository(dirname(__DIR__, 2) . '/Fixtures/finder/pint.json', null);

    expect($repository->finder())->toBe([
        'exclude' => [
            'my-dir',
        ],
        'notName' => [
            '*-my-file.php',
        ],
        'notPath' => [
            'path/to/excluded-file.php',
        ],
    ]);
});

it('may have a preset option', function () {
    $repository = new ConfigurationJsonRepository(dirname(__DIR__, 2) . '/Fixtures/preset/pint.json', null);

    expect($repository->preset())->toBe(PhpVersion::DEFAULT);
});
