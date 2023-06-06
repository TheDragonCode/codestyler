<?php

declare(strict_types=1);

namespace DragonCode\CodeStyler;

use Symfony\Component\Console\Input\InputInterface;

class Project
{
    public static function paths(InputInterface $input)
    {
        return $input->hasArgument('path') ? $input->getArgument('path') : static::path();
    }

    public static function path(): string|bool
    {
        return getcwd();
    }
}
