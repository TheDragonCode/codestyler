<?php

declare(strict_types=1);

namespace DragonCode\CodeStyler\Repositories;

use App\Repositories\ConfigurationJsonRepository;

class ConfigurationRepository extends ConfigurationJsonRepository
{
    /**
     * The list of available presets.
     *
     * @var array<int, string>
     */
    public static $presets = [
        '8.1',
        '8.1-risky',
        '8.2',
        '8.2-risky',
    ];
}
