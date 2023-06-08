<?php

abstract class Foo extends BaseCommand
{

    use Optionable;

    use ConfirmableTrait;

    use Isolatable;

    protected Processor|string $processor;
}

class Bar extends BaseCommand
{
    public const FOO = 'foo';

    public const BAR = 'bar';

    public const BAQ = 'baq';
}
