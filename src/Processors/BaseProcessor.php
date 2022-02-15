<?php

declare(strict_types=1);

namespace DragonCode\CodeStyler\Processors;

use DragonCode\CodeStyler\Contracts\Processor;
use Symfony\Component\Console\Output\OutputInterface;

abstract class BaseProcessor implements Processor
{
    public function __construct(
        protected OutputInterface $output
    ) {
    }
}
