<?php

declare(strict_types=1);

namespace DragonCode\CodeStyler\Actions;

use App\Output\ProgressOutput;
use DragonCode\CodeStyler\Factories\ConfigurationResolverFactory;
use LaravelZero\Framework\Exceptions\ConsoleException;
use PhpCsFixer\Error\ErrorsManager;
use PhpCsFixer\Runner\Runner;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\EventDispatcher\EventDispatcher;

use function is_null;
use function tap;

class FixCode
{
    public function __construct(
        protected ErrorsManager $errors,
        protected EventDispatcher $events,
        protected InputInterface $input,
        protected OutputInterface $output,
        protected ProgressOutput $progress,
    ) {}

    public function execute()
    {
        try {
            [$resolver, $totalFiles] = ConfigurationResolverFactory::fromIO($this->input, $this->output);
        }
        catch (ConsoleException $e) {
            return [$e->getCode(), []];
        }

        if (is_null($this->input->getOption('format'))) {
            $this->progress->subscribe();
        }

        /** @var array<string, array{appliedFixers: array<int, string>, diff: string}> $changes */
        $changes = (new Runner(
            $resolver->getFinder(),
            $resolver->getFixers(),
            $resolver->getDiffer(),
            $this->events,
            $this->errors,
            $resolver->getLinter(),
            $resolver->isDryRun(),
            $resolver->getCacheManager(),
            $resolver->getDirectory(),
            $resolver->shouldStopOnViolation()
        ))->fix();

        return tap([$totalFiles, $changes], fn () => $this->progress->unsubscribe());
    }
}
