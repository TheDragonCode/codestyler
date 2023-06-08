<?php

declare(strict_types=1);

class Foo
{
    public function __construct(
        protected string $foo,
        protected  int       $bar,
   private bool     $baz
    ) {
    }
}
