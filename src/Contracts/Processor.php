<?php

declare(strict_types=1);

namespace DragonCode\CodeStyler\Contracts;

interface Processor
{
    public function run(): void;
}
