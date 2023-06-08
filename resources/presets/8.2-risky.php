<?php

declare(strict_types=1);

use DragonCode\CodeStyler\Factories\ConfigurationFactory;

$default = require base_path('resources/presets/default.php');
$risky   = require base_path('resources/presets/risky.php');

return ConfigurationFactory::preset(array_merge($default, $risky, [
    '@PHP82Migration' => true,
]));
