<?php

declare(strict_types=1);

namespace DragonCode\CodeStyler\Commands;

use App\Actions\ElaborateSummary;
use DragonCode\CodeStyler\Actions\FixCode;
use LaravelZero\Framework\Commands\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;

class CheckCommand extends Command
{
    protected $signature = 'check';

    protected $description = 'Check code-style';

    public function handle(FixCode $fixCode, ElaborateSummary $summary): int
    {
        [$totalFiles, $changes] = $fixCode->execute();

        return $summary->execute($totalFiles, $changes);
    }

    protected function configure(): void
    {
        parent::configure();

        $this
            ->setDefinition(
                [
                    new InputArgument(
                        'path',
                        InputArgument::IS_ARRAY,
                        'The path to fix',
                        [(string) getcwd()]
                    ),

                    new InputOption('test',
                        '',
                        InputOption::VALUE_OPTIONAL,
                        'Test for code style errors without fixing them',
                        true
                    ),

                    new InputOption('dirty',
                        '',
                        InputOption::VALUE_NONE,
                        'Only fix files that have uncommitted changes'
                    ),

                    new InputOption(
                        'format',
                        '',
                        InputOption::VALUE_REQUIRED,
                        'The output format that should be used'
                    ),
                ]
            );
    }
}
