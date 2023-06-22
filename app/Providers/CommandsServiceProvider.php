<?php

declare(strict_types=1);

namespace DragonCode\CodeStyler\Providers;

use App\Actions\ElaborateSummary;
use DragonCode\CodeStyler\Actions\FixCode;
use DragonCode\CodeStyler\Commands\DefaultCommand;
use Illuminate\Support\ServiceProvider;
use LaravelZero\Framework\Commands\Command;

use function resolve;

class CommandsServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->bindMethod(DefaultCommand::class);
    }

    protected function bindMethod(string $class): void
    {
        $this->app->bindMethod([$class, 'handle'], function (Command $command) {
            return $command->handle(
                resolve(FixCode::class),
                resolve(ElaborateSummary::class)
            );
        });
    }
}
