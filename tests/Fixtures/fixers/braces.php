<?php

if (true)
{
    // ..
}

try {
    // ..
} catch (\Exception $e) {
    // ..
}

$a = function ()

{
    // ..
};

new class ( )

{
    // ..
};

new class ( ) extends Bar
{

};

new class ( ) extends stdClass

{
    // ..
};

new class ( ) extends Foo

{
    protected bool $some = true;
};

new class ( ) {
    protected bool $value = true;
};

class Baq extends Qwerty{
    // ..
}

enum Art: int {
    case FOO = 1;
    case BAR = 2;
    case BAQ = 3;
}
