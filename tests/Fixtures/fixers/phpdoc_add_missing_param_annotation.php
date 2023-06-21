<?php

class PhpdocAddMissingParamAnnotation
{
    /**
     * Some instance.
     */
    public function __construct(
        //public ?Throwable $foo = null,
        public readonly ?Throwable $bar = null
    ) {}
}
