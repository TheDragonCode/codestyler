<?php

declare(strict_types=1);

namespace DragonCode\CodeStyler\Providers;

use App\Contracts\PathsRepository;
use App\Project;
use App\Repositories\ConfigurationJsonRepository as BaseConfigurationJsonRepository;
use DragonCode\CodeStyler\Helpers\PhpVersion;
use DragonCode\CodeStyler\Repositories\ConfigurationJsonRepository;
use DragonCode\CodeStyler\Repositories\GitPathsRepository;
use Illuminate\Support\ServiceProvider;
use Symfony\Component\Console\Input\InputInterface;

class RepositoriesServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->registerConfiguration();
        $this->registerPaths();
    }

    protected function registerConfiguration(): void
    {
        $this->app->singleton(ConfigurationJsonRepository::class, function () {
            $input = resolve(InputInterface::class);

            $risky = $input->getOption('risky') ? '-risky' : '';

            return new ConfigurationJsonRepository(
                $input->getOption('config') ?: Project::path() . '/pint.json',
                PhpVersion::get() . $risky
            );
        });

        $this->app->singleton(BaseConfigurationJsonRepository::class, ConfigurationJsonRepository::class);
    }

    protected function registerPaths(): void
    {
        $this->app->singleton(PathsRepository::class, function () {
            return new GitPathsRepository(
                Project::path(),
            );
        });
    }
}
