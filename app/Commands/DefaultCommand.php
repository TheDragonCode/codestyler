<?php

declare(strict_types=1);

namespace DragonCode\CodeStyler\Commands;

use App\Actions\ElaborateSummary;
use DragonCode\CodeStyler\Actions\FixCode;
use LaravelZero\Framework\Commands\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;

use function getcwd;

class DefaultCommand extends Command
{
    protected $signature = 'default';

    protected $description = 'Fix the coding style of the given path';

    public function handle(FixCode $fixCode, ElaborateSummary $summary): int
    {
        [$totalFiles, $changes] = $fixCode->execute();

        return $summary->execute($totalFiles, $changes);
    }

    protected function configure(): void
    {
        $this->setDefinition(
            [
                new InputArgument(
                    'path',
                    InputArgument::IS_ARRAY,
                    'The path to fix',
                    [(string) getcwd()]
                ),

                new InputOption(
                    'config',
                    '',
                    InputOption::VALUE_REQUIRED,
                    'The configuration that should be used'
                ),

                new InputOption(
                    'test',
                    '',
                    InputOption::VALUE_NONE,
                    'Test for code style errors without fixing them'
                ),

                new InputOption(
                    'risky',
                    '',
                    InputOption::VALUE_NONE,
                    'Allows the application of risky rules'
                ),

                new InputOption(
                    'diff',
                    '',
                    InputOption::VALUE_REQUIRED,
                    'Only fix files that have changed since branching off from the given branch',
                    null,
                    ['main', 'master', 'origin/main', 'origin/master']
                ),

                new InputOption(
                    'dirty',
                    '',
                    InputOption::VALUE_NONE,
                    'Only fix files that have uncommitted changes'
                ),

                new InputOption(
                    'bail',
                    '',
                    InputOption::VALUE_NONE,
                    'Test for code style errors without fixing them and stop on first error'
                ),

                new InputOption(
                    'repair',
                    '',
                    InputOption::VALUE_NONE,
                    'Fix code style errors but exit with status 1 if there were any changes made'
                ),

                new InputOption(
                    'output-to-file',
                    '',
                    InputOption::VALUE_REQUIRED,
                    'Output the test results to a file at this path'
                ),

                new InputOption(
                    'format',
                    '',
                    InputOption::VALUE_REQUIRED,
                    'The output format that should be used'
                ),

                new InputOption(
                    'parallel',
                    'p',
                    InputOption::VALUE_REQUIRED,
                    'Runs the linter in parallel (Experimental)',
                    true
                ),
            ]
        );
    }
}
