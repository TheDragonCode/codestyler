<?php

namespace DragonCode\CodeStyler\Providers;

use App\Repositories\ConfigurationJsonRepository as ConfigurationJsonRepositoryConcern;
use DragonCode\CodeStyler\Repositories\ConfigurationJsonRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(ConfigurationJsonRepositoryConcern::class, ConfigurationJsonRepository::class);
    }
}
