<?php

class Foo implements ShouldQueue, ShouldBeUnique
{
    protected string|array|null $environment = null;

    protected function getIsolateOption(): null|int|bool
    {
        return 1;
    }

    protected function castStep(string|null|int $value): ?int
    {
        return null;
    }
}
