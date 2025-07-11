# Changelog

All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.0.0/), and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## Unreleased

For a full diff see [`3.6.0...main`][3.6.0...main].

## [`3.6.0`][3.6.0]

For a full diff see [`3.5.0...3.6.0`][3.5.0...3.6.0].

### Added

- Added support for PHP 8.4 ([#428]), by [@localheinz]

## [`3.5.0`][3.5.0]

For a full diff see [`3.4.0...3.5.0`][3.4.0...3.5.0].

### Changed

- Allowed installation on PHP 8.4 ([#419]), by [@localheinz]

## [`3.4.0`][3.4.0]

For a full diff see [`3.3.0...3.4.0`][3.3.0...3.4.0].

### Changed

- Added support for PHP 8.0 ([#339]), by [@localheinz]
- Added support for PHP 7.4 ([#340]), by [@localheinz]

## [`3.3.0`][3.3.0]

For a full diff see [`3.2.0...3.3.0`][3.2.0...3.3.0].

### Changed

- Dropped support for PHP 8.0 ([#209]), by [@localheinz]
- Added support for PHP 8.3 ([#271]), by [@localheinz]

## [`3.2.0`][3.2.0]

For a full diff see [`3.1.0...3.2.0`][3.1.0...3.2.0].

### Added

- Added `Specification::not()` ([#123]), by [@localheinz]

### Changed

- Dropped support for PHP 7.4 ([#119]), by [@localheinz]

## [`3.1.0`][3.1.0]

For a full diff see [`3.0.0...3.1.0`][3.0.0...3.1.0].

### Added

- Added `Specification::closure()` ([#56]), by [@localheinz]
- Added `Specification::never()` ([#57]), by [@localheinz]
- Added `Specification::always()` ([#58]), by [@localheinz]

## [`3.0.0`][3.0.0]

For a full diff see [`2.1.0...3.0.0`][2.1.0...3.0.0].

### Added

- Added `Specification` ([#50]), by [@localheinz]
- Added `Specification::anyOf()` ([#53]), by [@localheinz]

### Removed

- Removed `JsonPointers`  ([#48]), by [@localheinz]

## [`2.1.0`][2.1.0]

For a full diff see [`2.0.0...2.1.0`][2.0.0...2.1.0].

### Added

- Added `JsonPointers` as a value object  ([#17]), by [@localheinz]

## [`2.0.0`][2.0.0]

For a full diff see [`1.0.0...2.0.0`][1.0.0...2.0.0].

### Added

- Added named constructors `JsonPointer::fromUriFragmentIdentifierString()` and `ReferenceToken::fromUriFragmentIdentifierString()` to allow creation from URI fragment identifier representations ([#6]), by [@localheinz]
- Added named constructor `JsonPointer::fromReferenceTokens()` to allow creation of `JsonPointer` from `ReferenceToken`s ([#9]), by [@localheinz]

### Changed

- Renamed named constructors and accessors of `Exception\InvalidJsonPointer`, `JsonPointer`, and `ReferenceToken` ([#4]) and ([#5]), by [@localheinz]

  - `Exception\InvalidJsonPointer::fromString()` to `Exception\InvalidJsonPointer::fromJsonString()`
  - `JsonPointer::fromString()` to `JsonPointer::fromJsonString()`
  - `JsonPointer::toString()` to `JsonPointer::toJsonString()`
  - `ReferenceToken::fromEscapedString()` to `ReferenceToken::fromJsonString()`
  - `ReferenceToken::fromUnescapedString()` to `ReferenceToken::fromString()`
  - `ReferenceToken::toEscapedString()` to `ReferenceToken::toJsonString()`
  - `ReferenceToken::toUnescapedString()` to `ReferenceToken::toString()`

## [`1.0.0`][1.0.0]

For a full diff see [`a5ba52c...1.0.0`][a5ba52c...1.0.0].

### Added

- Added `ReferenceToken` as a value object ([#1]), by [@localheinz]
- Added `JsonPointer` as a value object ([#2]), by [@localheinz]

[1.0.0]: https://github.com/ergebnis/json-pointer/releases/tag/1.0.0
[2.0.0]: https://github.com/ergebnis/json-pointer/releases/tag/2.0.0
[2.1.0]: https://github.com/ergebnis/json-pointer/releases/tag/2.1.0
[3.0.0]: https://github.com/ergebnis/json-pointer/releases/tag/3.0.0
[3.1.0]: https://github.com/ergebnis/json-pointer/releases/tag/3.1.0
[3.2.0]: https://github.com/ergebnis/json-pointer/releases/tag/3.2.0
[3.3.0]: https://github.com/ergebnis/json-pointer/releases/tag/3.3.0
[3.4.0]: https://github.com/ergebnis/json-pointer/releases/tag/3.4.0
[3.5.0]: https://github.com/ergebnis/json-pointer/releases/tag/3.5.0
[3.6.0]: https://github.com/ergebnis/json-pointer/releases/tag/3.6.0

[a5ba52c...1.0.0]: https://github.com/ergebnis/json-pointer/compare/a5ba52c...1.0.0
[1.0.0...main]: https://github.com/ergebnis/json-pointer/compare/1.0.0...main
[2.0.0...2.1.0]: https://github.com/ergebnis/json-pointer/compare/2.0.0...2.1.0
[2.1.0...3.0.0]: https://github.com/ergebnis/json-pointer/compare/2.1.0...3.0.0
[3.0.0...3.1.0]: https://github.com/ergebnis/json-pointer/compare/3.0.0...3.1.0
[3.1.0...3.2.0]: https://github.com/ergebnis/json-pointer/compare/3.1.0...3.2.0
[3.2.0...3.3.0]: https://github.com/ergebnis/json-pointer/compare/3.2.0...3.3.0
[3.3.0...3.4.0]: https://github.com/ergebnis/json-pointer/compare/3.3.0...3.4.0
[3.4.0...3.5.0]: https://github.com/ergebnis/json-pointer/compare/3.4.0...3.5.0
[3.5.0...3.6.0]: https://github.com/ergebnis/json-pointer/compare/3.5.0...3.6.0
[3.6.0...main]: https://github.com/ergebnis/json-pointer/compare/3.6.0...main

[#1]: https://github.com/ergebnis/json-pointer/pull/1
[#2]: https://github.com/ergebnis/json-pointer/pull/2
[#4]: https://github.com/ergebnis/json-pointer/pull/4
[#5]: https://github.com/ergebnis/json-pointer/pull/5
[#6]: https://github.com/ergebnis/json-pointer/pull/6
[#9]: https://github.com/ergebnis/json-pointer/pull/9
[#17]: https://github.com/ergebnis/json-pointer/pull/17
[#48]: https://github.com/ergebnis/json-pointer/pull/48
[#53]: https://github.com/ergebnis/json-pointer/pull/53
[#56]: https://github.com/ergebnis/json-pointer/pull/56
[#57]: https://github.com/ergebnis/json-pointer/pull/57
[#58]: https://github.com/ergebnis/json-pointer/pull/58
[#119]: https://github.com/ergebnis/json-pointer/pull/119
[#123]: https://github.com/ergebnis/json-pointer/pull/123
[#209]: https://github.com/ergebnis/json-pointer/pull/209
[#271]: https://github.com/ergebnis/json-pointer/pull/271
[#339]: https://github.com/ergebnis/json-pointer/pull/339
[#340]: https://github.com/ergebnis/json-pointer/pull/340
[#419]: https://github.com/ergebnis/json-pointer/pull/419
[#428]: https://github.com/ergebnis/json-pointer/pull/428

[@localheinz]: https://github.com/localheinz
