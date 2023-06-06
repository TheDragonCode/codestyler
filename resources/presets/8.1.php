<?php

declare(strict_types=1);

use DragonCode\CodeStyler\Factories\ConfigurationFactory;

$default = require __DIR__ . '/default.php';

$rules = array_merge($default['rules'] ?? [], [
    //
]);

return ConfigurationFactory::preset(array_merge($default, compact('rules')));
