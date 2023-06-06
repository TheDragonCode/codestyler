<?php

declare(strict_types=1);

namespace DragonCode\CodeStyler\Providers;

use App\Actions\ElaborateSummary;
use DragonCode\CodeStyler\Actions\FixCode;
use DragonCode\CodeStyler\Commands\CheckCommand;
use DragonCode\CodeStyler\Commands\FixCommand;
use Illuminate\Support\ServiceProvider;
use LaravelZero\Framework\Commands\Command;

class CommandsServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->bindMethod(CheckCommand::class);
        $this->bindMethod(FixCommand::class);
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
