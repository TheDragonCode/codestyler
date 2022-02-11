<?php

declare(strict_types=1);

namespace DragonCode\CodeStyler;

use DragonCode\CodeStyler\Contracts\Processor;
use DragonCode\Support\Concerns\Makeable;

class Application
{
    use Makeable;

    public function process(string $class): void
    {
        $this->resolve($class)->run();
    }
    

    protected function resolve(string $class): Processor
    {
        return new $class();
    }
}
