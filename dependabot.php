<?php

declare(strict_types=1);

$target_path = realpath('./.github/dependabot.yml');

$content = $target_path && file_exists($target_path) ? yaml_parse_file($target_path) : [];

$updates = $content['updates'] ?? [];

foreach ($updates as $update) {
    if ($update['package-ecosystem'] === 'github-actions') {
        exit(0);
    }
}

$updates[] = [
    'package-ecosystem' => 'github-actions',

    'directory' => '/',

    'schedule' => [
        'interval' => 'daily',
    ],
];

$content['version'] = 2;
$content['updates'] = $updates;

yaml_emit_file($target_path, $content);
