<?php

declare(strict_types=1);

namespace DragonCode\CodeStyler\Repositories;

use App\Repositories\ConfigurationJsonRepository as BaseConfiguration;

class ConfigurationJsonRepository extends BaseConfiguration
{
    public function rules(): array
    {
        return [];
    }
}
