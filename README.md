# PHP CodeStyler

![the dragon code php code styler](https://preview.dragon-code.pro/the-dragon-code/php-code-styler.svg?brand=github&invert=1)

[![Stable Version][badge_stable]][link_packagist]
[![Unstable Version][badge_unstable]][link_packagist]
[![Total Downloads][badge_downloads]][link_packagist]
[![Github Workflow Status][badge_build]][link_build]
[![License][badge_license]][link_license]

## Usage

```yaml
uses: dragon-code/codestyler@v1
with:
    path:
        - src
        - tests
    exclude: vendor
    config: .php-cs.php
```

## License

This package is licensed under the [MIT License](LICENSE).


[badge_build]:          https://img.shields.io/github/workflow/status/TheDragonCode/codestyler/phpunit?style=flat-square

[badge_downloads]:      https://img.shields.io/packagist/dt/dragon-code/codestyler.svg?style=flat-square

[badge_license]:        https://img.shields.io/packagist/l/dragon-code/codestyler.svg?style=flat-square

[badge_stable]:         https://img.shields.io/github/v/release/TheDragonCode/codestyler?label=stable&style=flat-square

[badge_unstable]:       https://img.shields.io/badge/unstable-dev--main-orange?style=flat-square

[link_build]:           https://github.com/TheDragonCode/codestyler/actions

[link_license]:         LICENSE

[link_packagist]:       https://packagist.org/packages/dragon-code/codestyler
