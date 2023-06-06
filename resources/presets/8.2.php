<?php

declare(strict_types=1);

use DragonCode\CodeStyler\Factories\ConfigurationFactory;

$default = require __DIR__ . '/default.php';

return ConfigurationFactory::preset(array_merge($default, [
    '@PHP82Migration' => true,
]));
