<?php

namespace Acme\Package;

use Acme\Bar;
use Acme\Foo;

class Foo
{
    protected $x;

    protected $y;

    public function foo()
    {
    }
}

class Bar
{
    use Acme\Bar;
    use Acme\Foo;
    public const X = 1;
    public const Y = 2;

    public $a;

    public $b;

    public function bar(): string
    {
        $a = 'a';

        $b = 'b';
    }

    public function bar_2()
    {
        return $this->a.$this->b;
    }

    public function bar_3()
    {
        echo 'null';

        return null;
    }
}

function function_declaration()
{
}

register_function('function_declaration');

enum Suit: string
{
    case clubs = 'C';
    case diamonds = 'D';
    case hearts = 'H';
    case spades = 'S';
}
