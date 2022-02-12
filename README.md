# PHP Code Styler

![the dragon code php code styler](https://preview.dragon-code.pro/the-dragon-code/php-code-styler.svg?brand=github&invert=1)

[![Stable Version][badge_stable]][link_repo]
[![Unstable Version][badge_unstable]][link_repo]
[![License][badge_license]][link_license]

## Installation

### Required

- PHP: ^8.0
- Composer: ^2.0

### Locally

```bash
composer global require dragon-code/codestyler
```

## Usage

### CLI

#### Check code-style

```bash
codestyle check
```

#### Fix code-style

```bash
codestyle fix
```

#### Update `.editorconfig`

```bash
codestyle editorconfig
```

#### Enable Dependabot

```bash
codestyle dependabot
```

### GitHub Action

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
                uses: TheDragonCode/php-codestyler@v1.10.0
```

### Fixer

Create a new `.github/workflows/lint-fixer.yml` file and add the content to it:

```yaml
name: "Code-Style Fixer"

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
                uses: TheDragonCode/php-codestyler@v1.10.0
                with:
                    # Activates the mode of accepting changes with the creation
                    # of commits.
                    fix: true

                    # Activates the actualization of the `.editorconfig` file.
                    # Works only when the `fix` option is enabled.
                    # By default, true
                    editorconfig: true

                    # Activates Dependabot file processing.
                    # Works only when the `fix` option is enabled.
                    # By default, true
                    dependabot: true
```

## Configuration

By default, the linter scans all files in the current launch folder, except for folders such as `vendor`, `node_modules` and `.github`.

```yaml
-   uses: TheDragonCode/php-codestyler@v1.10.0
```

By default, the linter only checks the code-style. If you want to apply the changes, then you need to activate this option:

```yaml
-   uses: TheDragonCode/php-codestyler@v1.10.0
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
>
> Or you can manually run the Dependabot rule creation script by executing the `codestyle dependabot` command.

## License

This package is licensed under the [MIT License](LICENSE).


[badge_license]:    https://img.shields.io/badge/license-MIT-green?style=flat-square

[badge_stable]:     https://img.shields.io/github/v/release/TheDragonCode/php-codestyler?label=stable&style=flat-square

[badge_unstable]:   https://img.shields.io/badge/unstable-dev--main-orange?style=flat-square

[link_license]:     LICENSE

[link_repo]:        https://github.com/TheDragonCode/php-codestyler
