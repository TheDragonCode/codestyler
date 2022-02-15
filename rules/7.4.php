<?php

declare(strict_types=1);

use PhpCsFixer\Config;

require __DIR__ . '/main.php';

$rules['@PHP70Migration'] = true;
$rules['@PHP71Migration'] = true;
$rules['@PHP73Migration'] = true;
$rules['@PHP74Migration'] = true;

return (new Config())
    ->setFinder($finder)
    ->setUsingCache(false)
    ->setRiskyAllowed(true)
    ->setRules($rules);
