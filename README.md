# PHP Code Styler

![the dragon code php code styler](https://preview.dragon-code.pro/the-dragon-code/php-code-styler.svg?brand=github&invert=1)

[![Stable Version][badge_stable]][link_repo]
[![Unstable Version][badge_unstable]][link_repo]
[![License][badge_license]][link_license]

## Usage

### Check

Create a new `.github/workflows/lint-check.yml` file and add the content to it:

```yaml
name: "Code-Style Check"

on: [ push, pull_request ]

jobs:
    build:
        runs-on: ubuntu-latest

        steps:
            -   name: Checkout code
                uses: actions/checkout@v2

            -   name: Checking PHP Syntax
                uses: TheDragonCode/php-codestyler@v1.5.5
```

### Fixer

Create a new `.github/workflows/lint-check.yml` file and add the content to it:

```yaml
name: "Code-Style Fix"

on:
    push:
        branches: [ main ]

jobs:
    fix:
        runs-on: ubuntu-latest

        steps:
            -   name: Checkout code
                uses: actions/checkout@v2

            -   name: Checking PHP Syntax
                uses: TheDragonCode/php-codestyler@v1.5.5
                with:
                    fix: true

```

## Configuration

By default, the linter scans the `.` with except `vendor`, `node_modules` and `.github` folders.

```yaml
-   uses: TheDragonCode/php-codestyler@v1.5.5
```

Also, by default, the linter only checks for compliance without making changes to the files.

If you want to apply changes to repository, then use the following example:

```yaml
-   uses: TheDragonCode/php-codestyler@v1.5.5
    with:
        fix: true
```

By default, GitHub Action does not allow versioning, so our project will create a configuration file for it, which will check for new versions once a day.

When Dependabot detects new versions of containers, it will automatically create a PR to your repository. So you don't need to keep track of updates - Dependabot will do everything
for you 💪😎

If the `.github/dependabot.yml` file has already been created, we will check it and add the necessary rules. So don't be afraid, nothing will be deleted 😎

> Note
>
> Files will be created only if you have specified `fix: true`.

## License

This package is licensed under the [MIT License](LICENSE).


[badge_license]:    https://img.shields.io/badge/license-MIT-green?style=flat-square

[badge_stable]:     https://img.shields.io/github/v/release/TheDragonCode/php-codestyler?label=stable&style=flat-square

[badge_unstable]:   https://img.shields.io/badge/unstable-dev--main-orange?style=flat-square

[link_license]:     LICENSE

[link_repo]:        https://github.com/TheDragonCode/php-codestyler
