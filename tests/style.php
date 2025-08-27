<?php

declare(strict_types=1);

class EmptyClass {}

class ConstructorClass
{
    public const First  = 0;
    public const Second = 1;

    public int $firstValue = 1;

    public int $secondValue = 1;

    public function __construct(
        protected int|string $value
    ) {}
}

class ValueClass
{
    /**
     * @param  int|string  $item  Some Value
     */
    public function value(int|string $item): int|string
    {
        $result = static fn () => $item;

        // Return value
        return $result();
    }

    public function alignment(): array
    {
        return [
            'foo'    => 'Foo',
            'bar'    => 'Bar',
            'qwerty' => 'Qwerty',

            'f1'   => 'F1',
            'f2'   => 'F2',
            'some' => 'Some',
        ];
    }
}

$newClass = new ValueClass;

$possibleFiles = [
    __DIR__ . '/../../../autoload.php',
    __DIR__ . '/../../autoload.php',
    __DIR__ . '/../vendor/autoload.php',
];
