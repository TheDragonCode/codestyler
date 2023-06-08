<?php

/**
 * @formatter:off
 */

$foo = 123;
$bar = 123;

function () {
    return 'foo';
};

function () {     return 'foo';};

fn   ( )=>   'foo' ;

$result = function   (    ){return    'foo'   ;     };

$result = fn()   =>    'foo'  ;

function(  )   use   (   $foo ,  &$bar  ){return    'foo'  ;   };

fn  (   )   =>    'foo' ;

$result = function(   )use($foo  )   {  return 'foo'  ;  };

$result =   fn   (  )   =>   'foo'  ;
