<?php

declare(strict_types=1);

namespace DragonCode\CodeStyler\Providers;

use DragonCode\CodeStyler\Repositories\ConfigurationRulesRepository;
use DragonCode\CodeStyler\Support\PhpVersion;
use Illuminate\Support\ServiceProvider;
use Symfony\Component\Console\Input\InputInterface;

class RepositoriesServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(ConfigurationRulesRepository::class, function () {
            $input = resolve(InputInterface::class);

            $risky = $input->hasOption('risky') && $input->getOption('risky') ? '-risky' : '';

            $version = $this->phpVersion();

            return new ConfigurationRulesRepository(
                __DIR__ . "/../../rules/$version$risky.php",
                'dragon-code'
            );
        });
    }

    protected function phpVersion(): string
    {
        return PhpVersion::make()->get();
    }
}
