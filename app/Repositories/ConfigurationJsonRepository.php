<?php

declare(strict_types=1);

namespace DragonCode\CodeStyler\Repositories;

use App\Repositories\ConfigurationJsonRepository as BaseConfiguration;
use DragonCode\CodeStyler\Helpers\PhpVersion;

class ConfigurationJsonRepository extends BaseConfiguration
{
    public function preset(): string
    {
        return $this->preset ?? PhpVersion::DEFAULT;
    }

    public function rules(): array
    {
        return [];
    }
}
