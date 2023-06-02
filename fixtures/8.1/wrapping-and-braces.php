<?php

use N\AnotherClassName;
use N\ClassName;
use N\OneMoreClassName;

$instance = new class ()
{
};

enum Suit: string
{
    case clubs = 'C';
    case diamonds = 'D';
    case hearts = 'H';
    case spades = 'S';
}

function f($a, $ab, $abc)
{
}

f(
    a  : 1,
    ab : 2,
    abc: 3
);

$j = 0;

function f2(array $arr)
{
}

f2([
    0 => 5,
    1 => 7,
]);

echo match ($j) {
    0 => 'zero',
    2 => 'two',
    42 => 'forty-two',
    default => throw new Exception()
};

namespace A;

#[Attribute]
#[Attribute(1, 2)]
function foo()
{
    return 0;
}

function bar(
    $x,
    $y,
    int $z = 1
) {
    $x = 0;
    // $x = 1
    do {
        ++$y;
    }
    while ($y < 10);

    if (true) {
        $x = 10;
    }
    elseif ($y < 10) {
        $x = 5;
    }
    elseif (true) {
        $x = 5;
    }

    for ($i = 0; $i < 10; ++$i) {
        $yy = $x > 2 ? 1 : 2;
    }

    while (true) {
        $x = 0;
    }

    while (true) {
        ++$x;
    }

    foreach ([
        'a' => 0,
        'b' => 1,
        'c' => 2,
    ] as $e1) {
        echo $e1;
    }

    $count = 10;

    $x = [
        'x',
        'y',
        [
            1 => 'abc',
            2 => 'def',
            3 => 'ghi',
        ],
    ];

    $zz = [
        0.1,
        0.2,
        0.3,
        0.4,
    ];

    $x = [
        0 => 'zero',
        123 => 'one two three',
        25 => 'two five',
    ];

    bar(0, bar(1, 'b'));
}

abstract class Foo extends FooBaseClass implements Bar1, Bar2, Bar3
{
    public const FIRST = 'first';
    public const SECOND = 0; // comment
    public const Z = -1;     // comment

    public $numbers = [
        'one',
        'two',
        'three',
        'four',
        'five',
        'six',
    ];

    public $v = 0;

    public $path = 'root';

    abstract protected function fFour();

    public function bar(
        $v,
        $w = 'a'
    ) {
        $y = $w;

        $result = foo('arg1', 'arg2', 10);

        switch ($v) {
            case 0:
                return 1;

            case 1:
                echo '1';
                break;

            case 2:
                break;

            default:
                $result = 10;
        }

        return $result;
    }

    public function fTwo(
        $strA,
        $strB,
        $strC,
        $strD
    ) {
        if (
            'one' == $strA
            || 'two' == $strB
            || 'three' == $strC
        ) {
            return $strA + $strB + $strC;
        }

        $x = $foo->one('a', 'b')->two('c', 'd', 'e')->three('fg')->four();

        $y = a()->b()->c();

        return $strD;
    }

    public function fThree(
        $strA,
        $strB,
        $strC,
        $strD,
        $strE
    ) {
        try {
        }
        catch (Exception $e) {
            foo();
        }
        finally {
            // do something
        }

        return $strA + $strB + $strC + $strD + $strE;
    }

    public static function fOne(
        #[Attribute(1, 2)]
        $argA,
        $argB,
        $argC,
        $argD,
        $argE,
        $argF,
        $argG,
        $argH
    ) {
        $x = $argA + $argB + $argC + $argD + $argE + $argF + $argG + $argH;

        [
            $field1,
            $field2,
            $field3,
            $filed4,
            $field5,
            $field6,
        ] = explode(',', $x);

        fTwo($argA, $argB, $argC, fThree($argD, $argE, $argF, $argG, $argH));

        $z = 'Some string' == $argA ? 'yes' : 'no';

        $colors = [
            'red',
            'green',
            'blue',
            'black',
            'white',
            'gray',
        ];

        $count = count($colors);

        for ($i = 0; $i < $count; ++$i) {
            $colorString = $colors[$i];
        }
    }
}
