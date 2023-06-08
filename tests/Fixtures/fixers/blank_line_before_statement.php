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

enum Suit: string
{
    case Clubs  =   'C';

    case Diamonds =   'D';

    case Hearts  =   'H';

    case Spades    =   'S';
}

class Baz
{
    protected const FOO1 = 1;

    protected const FOO2 = 1;

    protected const FOO3 = 1;

    public float $prop1;

    public float $prop2;

    public float $prop3;
}
