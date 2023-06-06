<?php

declare(strict_types=1);

namespace DragonCode\CodeStyler\Commands;

use DragonCode\CodeStyler\Actions\ElaborateSummary;
use DragonCode\CodeStyler\Actions\FixCode;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;

class FixCommand extends BaseCommand
{
    protected $signature = 'fix';

    protected $description = 'Fix code-style';

    public function handle(): int
    {
        [$totalFiles, $changes] = resolve(FixCode::class)->execute();

        return resolve(ElaborateSummary::class)->execute($totalFiles, $changes);
    }

    protected function configure(): void
    {
        parent::configure();

        $this->setDefinition([
            new InputArgument(
                'path',
                InputArgument::IS_ARRAY,
                'The path to fix',
                [(string) getcwd()]
            ),

            new InputOption('test',
                '',
                InputOption::VALUE_NONE,
                'Test for code style errors without fixing them'
            ),

            new InputOption(
                'format',
                '',
                InputOption::VALUE_REQUIRED,
                'The output format that should be used'
            ),
        ]);
    }

    protected function process(): string
    {
    }
}
