<?php

declare(strict_types=1);

namespace DragonCode\CodeStyler\Contracts;

use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

interface Processor
{
    public function __construct(InputInterface $input, OutputInterface $output);

    public function run(): void;
}
