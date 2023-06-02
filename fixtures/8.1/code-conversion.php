<?php

class Baz
{
    public float $prop;

    public function foo(
        ?bool $one = null,
        int $two = 0,
        string $three = 'String'
    ): int {
        if (true) {
            $x = [
                0 => 'zero',
                123 => 'one two three',
                25 => 'two five',
            ];

            $a = isset($one, $two, $three);

            $m = match ($two) {
                1 => 'one',
                2 => 'two',
                3 => 'three'
            };
        }
        elseif (null) {
            echo null;
        }
        elseif (false) {
            $y = function () use ($a) {
                return $a;
            };

            return 0;
        }

        return 1;
    }
}
