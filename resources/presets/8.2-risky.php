<?php

declare(strict_types=1);

use DragonCode\CodeStyler\Factories\ConfigurationFactory;

$default = require __DIR__ . '/default.php';

return ConfigurationFactory::preset(array_merge($default, [
    '@PHP70Migration:risky' => true,
    '@PHP71Migration:risky' => true,
    '@PHP74Migration:risky' => true,
    '@PHP80Migration:risky' => true,
    '@PHP82Migration'       => true,
    '@PER:risky'            => true,
    '@Symfony:risky'        => true,
]));
