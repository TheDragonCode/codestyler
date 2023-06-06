<?php

declare(strict_types=1);

namespace DragonCode\CodeStyler\Providers;

use App\Repositories\ConfigurationJsonRepository;
use DragonCode\CodeStyler\Repositories\ConfigurationRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(ConfigurationJsonRepository::class, ConfigurationRepository::class);
    }
}
