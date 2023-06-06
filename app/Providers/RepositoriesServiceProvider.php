<?php

declare(strict_types=1);

namespace DragonCode\CodeStyler\Providers;

use App\Contracts\PathsRepository;
use App\Repositories\GitPathsRepository;
use DragonCode\CodeStyler\Helpers\PhpVersion;
use DragonCode\CodeStyler\Project;
use DragonCode\CodeStyler\Repositories\ConfigurationJsonRepository;
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

            $risky = $input->hasOption('risky') && $input->getOption('risky') ? '-risky' : '';

            return new ConfigurationJsonRepository(
                Project::path() . '/pint.json',
                PhpVersion::get() . $risky
            );
        });
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
