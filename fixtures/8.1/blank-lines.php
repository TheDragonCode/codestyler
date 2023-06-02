<?php

namespace Acme\Package;

use Acme\Bar;
use Acme\Foo;

class Foo
{
    protected $x;

    protected $y;

    function foo()
    {

    }
}

class Bar
{
    const X = 1;

    const Y = 2;

    var $a;

    var $b;

    function bar()
    {
        $a = "a";

        $b = "b";
    }

    function bar_2()
    {
        return $this->a . $this->b;
    }

    function bar_3()
    {
        echo "null";

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
