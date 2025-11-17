<?php

declare(strict_types=1);

use Rector\Configuration\RectorConfigBuilder;

/** @var RectorConfigBuilder $config */
$config = require __DIR__ . '/presets/rector/laravel.php';

return $config->withPaths([
    'bin',
    'presets',
    'src',
    'rector.php',
]);
