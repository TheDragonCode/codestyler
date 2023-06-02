<?php

declare(strict_types=1);

class Foo
{
    public function foo($x, $z)
    {
        global $k, $s1;

        $obj->foo(x: 1)->bar();

        $sample = [1, 'a', $b];

        $arr = [0 => 'zero', 1 => 'one'];

        call_func(function () {
            return 0;
        });

        call_func(fn () => 0);

        for ($i = 0; $i < $x; ++$i) {
            $y += ($y ^ 0x123) << 2;
        }

        $k = $x > 15 ? 1 : 2;
        $k = $x ?: 0;
        $k = $x ?? $z;
        $k = $x <=> $z;

        do {
            try {
                if ($x < !0 && !$x < 10) {
                    while ($x != $y) {
                        $x = f($x * 3 + 5);
                    }
                    $z += 2;
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

                    case 2:
                        $s1 = 'two';
                        break;

                    default:
                        $s1 = 'other';
                }
            }
            catch (Exception $e) {
                $t = $one[0];
                $u = $one['str'];
                $v = $one[$x[1]];
            }
            finally {
                // do something
            }
        }
        while ($x < 0);
    }
}

function bar(): Foo
{
}

enum a: int
{
}

new class () extends Foo
{
};

new class ()
{
    public function __construct(
        protected Closure $foo1,
        protected int $foo2,
        protected string $foo3,
        protected bool $foo4,
    ) {
        $this->resolveExcludes();
    }

    public function get(): string
    {
    }
};
