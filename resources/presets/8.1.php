<?php

declare(strict_types=1);

use DragonCode\CodeStyler\Factories\ConfigurationFactory;

$default = require base_path('resources/presets/default.php');

return ConfigurationFactory::preset(array_merge($default, [
]));
