<?php

declare(strict_types=1);

namespace DragonCode\CodeStyler\Repositories;

use App\Repositories\ConfigurationJsonRepository as BaseConfiguration;
use DragonCode\CodeStyler\Helpers\PhpVersion;

class ConfigurationJsonRepository extends BaseConfiguration
{
    public function preset(): string
    {
        $this->validate();

        return $this->preset ?? PhpVersion::DEFAULT;
    }

    public function rules(): array
    {
        $this->validate();

        return [];
    }

    protected function validate(): void
    {
        $this->get();
    }
}
