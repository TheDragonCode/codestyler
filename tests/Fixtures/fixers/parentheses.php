<?php

new class
{
    // ..
};

new class ( )
{
    // ..
};

new class extends Foo
{
    protected bool $some = true;
};

new class ( ) extends Bar
{
    protected bool $some = true;
};

$x = new X;
$y = new class {};

$x = new X();
$y = new class() {};
