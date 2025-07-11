# json-pointer

[![Integrate](https://github.com/ergebnis/json-pointer/workflows/Integrate/badge.svg)](https://github.com/ergebnis/json-pointer/actions)
[![Merge](https://github.com/ergebnis/json-pointer/workflows/Merge/badge.svg)](https://github.com/ergebnis/json-pointer/actions)
[![Release](https://github.com/ergebnis/json-pointer/workflows/Release/badge.svg)](https://github.com/ergebnis/json-pointer/actions)
[![Renew](https://github.com/ergebnis/json-pointer/workflows/Renew/badge.svg)](https://github.com/ergebnis/json-pointer/actions)

[![Code Coverage](https://codecov.io/gh/ergebnis/json-pointer/branch/main/graph/badge.svg)](https://codecov.io/gh/ergebnis/json-pointer)

[![Latest Stable Version](https://poser.pugx.org/ergebnis/json-pointer/v/stable)](https://packagist.org/packages/ergebnis/json-pointer)
[![Total Downloads](https://poser.pugx.org/ergebnis/json-pointer/downloads)](https://packagist.org/packages/ergebnis/json-pointer)
[![Monthly Downloads](http://poser.pugx.org/ergebnis/json-pointer/d/monthly)](https://packagist.org/packages/ergebnis/json-pointer)

This project provides a [`composer`](https://getcomposer.org) package with an abstraction of a [JSON pointer](https://datatracker.ietf.org/doc/html/rfc6901).

## Installation

Run

```sh
composer require ergebnis/json-pointer
```

## Usage

### `ReferenceToken`

You can create a `ReferenceToken` from a `string` value:

```php
<?php

declare(strict_types=1);

use Ergebnis\Json\Pointer;

$referenceToken = Pointer\ReferenceToken::fromString('foo/9000/😆');

$referenceToken->toJsonString();                  // 'foo~19000~😆'
$referenceToken->toString();                      // 'foo/9000/😆'
$referenceToken->toUriFragmentIdentifierString(); // 'foo~19000~1%F0%9F%98%86'
```

You can create a `ReferenceToken` from a [JSON `string` value](https://datatracker.ietf.org/doc/html/rfc6901#section-5):

```php
<?php

declare(strict_types=1);

use Ergebnis\Json\Pointer;

$referenceToken = Pointer\ReferenceToken::fromJsonString('foo~19000~😆');

$referenceToken->toJsonString();                  // 'foo~19000~😆'
$referenceToken->toString();                      // 'foo/9000/😆'
$referenceToken->toUriFragmentIdentifierString(); // 'foo~19000~1%F0%9F%98%86'
```

You can create a `ReferenceToken` from a [URI fragment identifier `string` value](https://datatracker.ietf.org/doc/html/rfc6901#section-6):

```php
<?php

declare(strict_types=1);

use Ergebnis\Json\Pointer;

$referenceToken = Pointer\ReferenceToken::fromUriFragmentIdentifierString('foo~19000~1%F0%9F%98%86');

$referenceToken->toJsonString();                  // 'foo~19000~😆'
$referenceToken->toString();                      // 'foo/9000/😆'
$referenceToken->toUriFragmentIdentifierString(); // 'foo~19000~1%F0%9F%98%86'
```

You can create a `ReferenceToken` from an `int` value:

```php
<?php

declare(strict_types=1);

use Ergebnis\Json\Pointer;

$referenceToken = Pointer\ReferenceToken::fromInt(9001);

$referenceToken->toJsonString();                  // '9001'
$referenceToken->toString();                      // '9001'
$referenceToken->toUriFragmentIdentifierString(); // '9001'
```

You can compare `ReferenceToken`s:

```php
<?php

declare(strict_types=1);

use Ergebnis\Json\Pointer;

$one = Pointer\ReferenceToken::fromString('foo/bar');
$two = Pointer\ReferenceToken::fromJsonString('foo~1bar');
$three = Pointer\ReferenceToken::fromString('foo/9000');

$one->equals($two);   // true
$one->equals($three); // false
```

### `JsonPointer`

You can create a `JsonPointer` referencing a document:

```php
<?php

declare(strict_types=1);

use Ergebnis\Json\Pointer;

$jsonPointer = Pointer\JsonPointer::document();

$jsonPointer->toJsonString();                  // ''
$jsonPointer->toUriFragmentIdentifierString(); // '#'
```

You can create a `JsonPointer` from a [JSON `string` representation](https://datatracker.ietf.org/doc/html/rfc6901#section-5) value:

```php
<?php

declare(strict_types=1);

use Ergebnis\Json\Pointer;

$jsonPointer = Pointer\JsonPointer::fromJsonString('/foo/bar/😆');

$jsonPointer->toJsonString();                  // '/foo/bar/😆'
$jsonPointer->toUriFragmentIdentifierString(); // '#/foo/bar/%F0%9F%98%86'
```

You can create a `JsonPointer` from a [URI fragment identifier `string` representation](https://datatracker.ietf.org/doc/html/rfc6901#section-6) value:

```php
<?php

declare(strict_types=1);

use Ergebnis\Json\Pointer;

$jsonPointer = Pointer\JsonPointer::fromUriFragmentIdentifierString('#/foo/bar/%F0%9F%98%86');

$jsonPointer->toJsonString();                  // '/foo/bar/😆'
$jsonPointer->toUriFragmentIdentifierString(); // '#/foo/bar/%F0%9F%98%86'
```

You can create a `JsonPointer` from `ReferenceToken`s:

```php
<?php

declare(strict_types=1);

use Ergebnis\Json\Pointer;

$referenceTokens = [
    Pointer\ReferenceToken::fromString('foo'),
    Pointer\ReferenceToken::fromString('bar'),
];

$jsonPointer = Pointer\JsonPointer::fromReferenceTokens(...$referenceTokens);

$jsonPointer->toJsonString();                  // '/foo/bar'
$jsonPointer->toUriFragmentIdentifierString(); // '#/foo/bar'
```

You can compare `JsonPointer`s:

```php
<?php

declare(strict_types=1);

use Ergebnis\Json\Pointer;

$one = Pointer\JsonPointer::fromJsonString('/foo/bar');
$two = Pointer\JsonPointer::fromJsonString('/foo~1bar');
$three = Pointer\JsonPointer::fromUriFragmentIdentifierString('#/foo/bar');

$one->equals($two);   // false
$one->equals($three); // true
```

You can append a `ReferenceToken` to a `JsonPointer`:

```php
<?php

declare(strict_types=1);

use Ergebnis\Json\Pointer;

$jsonPointer = Pointer\JsonPointer::fromJsonString('/foo/bar');

$referenceToken = Pointer\ReferenceToken::fromString('baz');

$newJsonPointer = $jsonPointer->append($referenceToken);

$newJsonPointer->toJsonString();                  // '/foo/bar/baz'
$newJsonPointer->toUriFragmentIdentifierString(); // '#foo/bar/baz'
```

### `Specification`

You can create a `Specification` that is always satisfied by a `JsonPointer`:

```php
<?php

declare(strict_types=1);

use Ergebnis\Json\Pointer;

$specification = Pointer\Specification::always();

$specification->isSatisfiedBy(Pointer\JsonPointer::fromJsonString('/foo'));     // true
$specification->isSatisfiedBy(Pointer\JsonPointer::fromJsonString('/foo/bar')); // true
```

You can create a `Specification` that is satisfied when a closure returns `true` for a `JsonPointer`:

```php
<?php

declare(strict_types=1);

use Ergebnis\Json\Pointer;

$specification = Pointer\Specification::closure(static function (Pointer\JsonPointer $jsonPointer) {
    return $jsonPointer->toJsonString() === '/foo/bar';
});

$specification->isSatisfiedBy(Pointer\JsonPointer::fromJsonString('/foo'));     // false
$specification->isSatisfiedBy(Pointer\JsonPointer::fromJsonString('/foo/bar')); // true
```

You can create a `Specification` that is satisfied when a `JsonPointer` equals another `JsonPointer`:

```php
<?php

declare(strict_types=1);

use Ergebnis\Json\Pointer;

$specification = Pointer\Specification::equals(Pointer\JsonPointer::fromJsonString('/foo/bar'));

$specification->isSatisfiedBy(Pointer\JsonPointer::fromJsonString('/foo'));     // false
$specification->isSatisfiedBy(Pointer\JsonPointer::fromJsonString('/foo/bar')); // true
```

You can create a `Specification` that is never satisfied by a `JsonPointer`:

```php
<?php

declare(strict_types=1);

use Ergebnis\Json\Pointer;

$specification = Pointer\Specification::never();

$specification->isSatisfiedBy(Pointer\JsonPointer::fromJsonString('/foo'));     // false
$specification->isSatisfiedBy(Pointer\JsonPointer::fromJsonString('/foo/bar')); // false
```

You can create a `Specification` that is satisfied when another `Specification` is not satisfied by a `JsonPointer`:

```php
<?php

declare(strict_types=1);

use Ergebnis\Json\Pointer;

$specification = Pointer\Specification::not(Pointer\Specification::equals(Pointer\JsonPointer::fromJsonString('/foo/bar')));

$specification->isSatisfiedBy(Pointer\JsonPointer::fromJsonString('/foo'));     // true
$specification->isSatisfiedBy(Pointer\JsonPointer::fromJsonString('/foo/bar')); // false
```

You can compose `Specification`s to find out if a `JsonPointer` satisfies any of them:

```php
<?php

declare(strict_types=1);

use Ergebnis\Json\Pointer;

$specification = Pointer\Specification::anyOf(
    Pointer\Specification::closure(static function(Pointer\JsonPointer $jsonPointer) {
        return $jsonPointer->toJsonString() === '/foo/bar';
    }),
    Pointer\Specification::equals(Pointer\JsonPointer::fromJsonString('/foo/baz')),
    Pointer\Specification::never(),
);

$specification->isSatisfiedBy(Pointer\JsonPointer::fromJsonString('/foo'));     // false
$specification->isSatisfiedBy(Pointer\JsonPointer::fromJsonString('/foo/bar')); // true
$specification->isSatisfiedBy(Pointer\JsonPointer::fromJsonString('/foo/baz')); // true
```

## Changelog

The maintainers of this project record notable changes to this project in a [changelog](CHANGELOG.md).

## Contributing

The maintainers of this project suggest following the [contribution guide](.github/CONTRIBUTING.md).

## Code of Conduct

The maintainers of this project ask contributors to follow the [code of conduct](https://github.com/ergebnis/.github/blob/main/CODE_OF_CONDUCT.md).

## General Support Policy

The maintainers of this project provide limited support.

You can support the maintenance of this project by [sponsoring @localheinz](https://github.com/sponsors/localheinz) or [requesting an invoice for services related to this project](mailto:am@localheinz.com?subject=ergebnis/json-pointer:%20Requesting%20invoice%20for%20services).

## PHP Version Support Policy

This project supports PHP versions with [active and security support](https://www.php.net/supported-versions.php).

The maintainers of this project add support for a PHP version following its initial release and drop support for a PHP version when it has reached the end of security support.

## Security Policy

This project has a [security policy](.github/SECURITY.md).

## License

This project uses the [MIT license](LICENSE.md).

## Social

Follow [@localheinz](https://twitter.com/intent/follow?screen_name=localheinz) and [@ergebnis](https://twitter.com/intent/follow?screen_name=ergebnis) on Twitter.
