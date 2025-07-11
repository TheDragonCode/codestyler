# Changelog

All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.0.0/), and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## Unreleased

For a full diff see [`1.4.0...main`][1.4.0...main].

## [`1.4.0`][1.4.0]

For a full diff see [`1.3.0...1.4.0`][1.3.0...1.4.0].

### Added

- Added support for PHP 8.4 ([#340]), by [@localheinz]

## [`1.3.0`][1.3.0]

For a full diff see [`1.2.0...1.3.0`][1.2.0...1.3.0].

### Changed

- Allowed installation of PHP 8.4 ([#318]), by [@localheinz]

## [`1.2.0`][1.2.0]

For a full diff see [`1.1.0...1.2.0`][1.1.0...1.2.0].

### Changed

- Added support for PHP 8.0 ([#226]), by [@localheinz]
- Added support for PHP 7.4 ([#227]), by [@localheinz]

## [`1.1.0`][1.1.0]

For a full diff see [`1.0.1...1.1.0`][1.0.1...1.1.0].

### Changed

- Dropped support for PHP 8.0 ([#90]), by [@localheinz]
- Added support for PHP 8.3 ([#151]), by [@localheinz]

## [`1.0.1`][1.0.1]

For a full diff see [`1.0.0...1.0.1`][1.0.0...1.0.1].

### Fixed

- Decoded JSON `string` to an object, not an associative array, when constructing `Json` from file name ([#3]), by [@localheinz]

## [`1.0.0`][1.0.0]

For a full diff see [`c020e6f...1.0.0`][c020e6f...1.0.0].

### Added

- Imported `Json` from [`ergebnis/json-normalizer`](https://github.com/ergebnis/json-normalizer/tree/3.0.0) ([#1]), by [@localheinz]
- Imported and merged `Json` from [`ergebnis/json-schema-validator`](https://github.com/ergebnis/json-schema-validator/tree/3.2.0) ([#2]), by [@localheinz]

[1.0.0]: https://github.com/ergebnis/json/releases/tag/1.0.0
[1.0.1]: https://github.com/ergebnis/json/releases/tag/1.0.1
[1.1.0]: https://github.com/ergebnis/json/releases/tag/1.1.0
[1.2.0]: https://github.com/ergebnis/json/releases/tag/1.2.0
[1.3.0]: https://github.com/ergebnis/json/releases/tag/1.3.0
[1.4.0]: https://github.com/ergebnis/json/releases/tag/1.4.0

[c020e6f...1.0.0]: https://github.com/ergebnis/json/compare/c020e6f...1.0.0
[1.0.0...1.0.1]: https://github.com/ergebnis/json/compare/1.0.0...1.0.1
[1.0.1...1.1.0]: https://github.com/ergebnis/json/compare/1.0.1...1.1.0
[1.1.0...1.2.0]: https://github.com/ergebnis/json/compare/1.1.0...1.2.0
[1.2.0...1.3.0]: https://github.com/ergebnis/json/compare/1.2.0...1.3.0
[1.3.0...1.4.0]: https://github.com/ergebnis/json/compare/1.3.0...1.4.0
[1.4.0...main]: https://github.com/ergebnis/json/compare/1.4.0...main

[#1]: https://github.com/ergebnis/json/pull/1
[#2]: https://github.com/ergebnis/json/pull/2
[#3]: https://github.com/ergebnis/json/pull/3
[#90]: https://github.com/ergebnis/json/pull/90
[#151]: https://github.com/ergebnis/json/pull/151
[#226]: https://github.com/ergebnis/json/pull/226
[#227]: https://github.com/ergebnis/json/pull/227
[#318]: https://github.com/ergebnis/json/pull/318
[#340]: https://github.com/ergebnis/json/pull/340

[@localheinz]: https://github.com/localheinz
