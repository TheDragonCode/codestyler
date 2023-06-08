<?php

declare(strict_types=1);

namespace Acme\Package;

use Acme\Bar;
use Acme\Foo;
use N\{AnotherClassName,ClassName,OneMoreClassName};

class Foo2
{
    public function foo($x, $z)
    {
        global $k, $s1;
        $obj->foo(x: 1)->bar();
        $arr = [0 => 'zero', 1  =>   'one'];
        call_func(function () {            return 0; });
        call_func(fn () => 0);
        for ($i = 0; $i < $x; ++$i) {
            $y += ($y ^ 0x123) << 2;
        }
        $k   =  $x > 15 ? 1 : 2;
        $k   =  $x ?: 0;
        $k   =  $x ?? $z;
        $k   =  $x <=> $z;

        do {
            try {
                if ($x < ! 0 && ! $x < 10) {
                    while ($x != $y) {
                        $x = f($x * 3 + 5);
                    }                    $z += 2;
                }
                elseif ($x > 20) {
                    $z = $x << 1;
                }
                else {
                    $z = $x | 2;
                }
                $j = (int) $z;

                switch ($j) {
                    case 0:
                        $s1 = 'zero';

                        break;

                    case 2:                        $s1 = 'two';
                        break;

                    default:                        $s1 = 'other';
                }
            }
            catch (RuntimeException|Exception   $e) {
                $t  = $one[0];
                $u  =   $one['str'];
                $v  = $one[$x[1]];
            }
            finally {
                // do something
            }
        }
        while ($x < 0);
    }
}
function f($a, $ab, $abc)
{
}

f(
    a     : 1,
    ab: 2,
    abc  : 3
);
$j = 0;

function f2(array $arr)
{
}

f2([0 => 5,
    1 => 7,
]);

echo match ($j) {
    0       => 'zero',
    2       => 'two',
    42      => 'forty-two',

    default => throw new Exception()
};

/**
 *  This is a sample function to illustrate additional PHP
 * formatter options.
 *
 * @author J.S.
 * @license GPL
 *
 * @param  string$three The third parameter with a longer comment to illustrate wrapping
 * @param $one The first parameter
 * @param int $two The second parameter
 *
 * @return void
 */
class Baz
{
    protected const FOO1 = 1;

    protected const FOO2 = 1;

    protected const FOO3 = 1;

    public float   $prop1;

    public float   $prop2;

    public float   $prop3;

    public function foo(
        ?bool $one = null,
        int $two = 0,
        string $three = 'String'
    ): int {
        if (true) {
            $x = [0   => 'zero',
                123   => 'one two three',
                25    => 'two five'];
            $a = isset(
                $one,
                $two,                $three,            );
            $m = match ($two) {
                1 => 'one',                2 => 'two',                3 => 'three'
            };
        }
        elseif (null) {
            echo null;
        }
        elseif (false) {
            $y = function () use ($a
            ) {
                return $a;
            };

            return 0;
        }
        else {
            return 1;
        }
    }
}

class Foo3
{
    public $x;

    public $y;

    public function foo()
    {
    }
}

class Bar
{
    public const X = 1;

    public const Y = 2;

    public $a;

    public $b;

    public function bar()
    {
        $a = 'a';

        $b = 'b';
    }

    public function bar_2()
    {
        return $this->a . ' ' . $this->b;
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

$instance = new class ()
{
};

$instance = new class () extends Bar
{
};

$instance = new class () extends Bar
{
};

function bar(): Foo
{
}

#[Attribute]
#[Attribute(1, 2)]
function foo()
{
    return 0;
}

function bar3($x,
    $y,
    int $z  =  1
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
    $x     = [
        'x',
        'y',
        [
            1 => 'abc',
            2 => 'def',
            3 => 'ghi',
        ],
    ];
    $zz    = [
        0.1,
        0.2,
        0.3,
        0.4,
    ];
    $x = [
        0   => 'zero',
        123 => 'one two three',
        25  => 'two five',
    ];
    bar(0,
        bar(1,
            'b'));
}

abstract class Foo4 extends FooBaseClass implements Bar1, Bar2, Bar3
{
    public const FIRST = 'first';

    public const SECOND = 0;            // comment

    public const Z = -1; // comment

    public $numbers = [
        'one',
        'two',            'three',            'four',            'five',            'six',
    ];

    public $v = 0;

    public $path = 'root';

    abstract protected function fFour(
    );

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
        $x
            = $argA
            + $argB
            + $argC
            + $argD
            + $argE
            + $argF
            + $argG
            + $argH;
        [
            $field1,
            $field2,
            $field3,
            $filed4,
            $field5,
            $field6,
        ] = explode(',', $x);
        fTwo($argA,
            $argB,
            $argC,
            fThree($argD,
                $argE,
                $argF,
                $argG,
                $argH));
        $z
            = $argA == 'Some string'
                ? 'yes' : 'no';
        $colors
            = [
                'red',
                'green',
                'blue',
                'black',
                'white',
                'gray',
            ];
        $count  = count($colors);
        for ($i = 0; $i < $count;
            ++$i) {
            $colorString
                = $colors[$i];
        }
    }

    public function bar(
        $v,
        $w = 'a'
    ) {
        $y      = $w;
        $result = foo('arg1',
            'arg2',
            10);

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
            $strA == 'one'
            || $strB
                     == 'two'
            || $strC == 'three'
        ) {
            return $strA
                + $strB
                + $strC;
        }
        $x
            = $foo->one('a', 'b')
                ->two('c', 'd', 'e')
                ->three('fg')
                ->four();
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

        return $strA                + $strB                + $strC                + $strD
                                    + $strE;
    }
}

function foo()
{
    if ($x > 5) {
        echo 'bar';
    }

    return 'string';
}
