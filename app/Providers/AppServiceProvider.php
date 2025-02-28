<?php

declare(strict_types=1);

namespace DragonCode\CodeStyler\Providers;

use App\Repositories\ConfigurationJsonRepository as ConfigurationJsonRepositoryConcern;
use DragonCode\CodeStyler\Repositories\ConfigurationJsonRepository;
use Illuminate\Support\ServiceProvider;
use PhpCsFixer\Error\ErrorsManager;
use Symfony\Component\EventDispatcher\EventDispatcher;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(ConfigurationJsonRepositoryConcern::class, ConfigurationJsonRepository::class);

        $this->app->singleton(ErrorsManager::class, fn () => new ErrorsManager());
        $this->app->singleton(EventDispatcher::class, fn () => new EventDispatcher());
    }
}
