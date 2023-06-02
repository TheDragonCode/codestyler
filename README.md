# The Dragon Code Styler

![the dragon code code styler](https://preview.dragon-code.pro/the-dragon-code/code-styler.svg?brand=php&invert=1)

[![Stable Version][badge_stable]][link_repo]
[![Unstable Version][badge_unstable]][link_repo]
[![Total Downloads][badge_downloads]][link_packagist]
[![License][badge_license]][link_license]

## Installation

### Required

- PHP: ^8.1
- Composer: ^2.0

### Locally

```bash
composer global require dragon-code/codestyler
```

## Usage

When you run the commands in the base path of the project, the `composer.json` file will be automatically read, from which the minimum PHP version for your project will be taken.

This is necessary to draw up rules for applying the codestyle.

For example, if your project supports PHP 8.0 and above, and you use the `mkdir($path, 0755)` function in it, then applying the rules for PHP 8.0 will break your code because it
will replace `0755` with `0o755` (`mkdir($path, 0o755)`).

To prevent this from happening, we check the minimum PHP version.

Please note that the `composer.json` file is only read if the script execution is started in the folder with it.

### CLI

```bash
# Check code-style.
codestyle check

# Check and fix code-style.
codestyle fix

# Update `.editorconfig`.
codestyle editorconfig

# Update Dependabot rules.
codestyle dependabot
```

### Options

#### Risky

Allows to set whether risky rules may run:

```bash
codestyle check --risky
codestyle fix --risky
```

### GitHub Action

#### Check

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
                uses: TheDragonCode/codestyler@v3
```

#### Fixer

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
                uses: TheDragonCode/codestyler@v3
                with:
                    # This token uses GitHub Actions to execute code.
                    # Required when `fix` is `true`.
                    # The default value is `${{ secrets.GITHUB_TOKEN }}`.
                    github_token: ${{ secrets.YOUR_TOKEN }}

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

                    # Normalizing `composer.json`.
                    # Works only when the `fix` option is enabled.
                    # By default, true
                    normalize: true
```

Since the changes are pushed to the master branch, GitHub can block this action with a security policy.

To solve this problem, you need to be [`create`](https://github.com/settings/tokens/new?scopes=repo&description=The%20Dragon%20Code:%20Styler) of your account token and specify it
in the `Actions secrets` section of the repository or organization.

The name of the variable containing the token must be passed to the `github_token` key.

### Simplify Check & Fix

```yaml
name: code-style

on:
    push:
    pull_request:

permissions: write-all

jobs:
    style:
        runs-on: ubuntu-latest

        steps:
            -   name: Checkout code
                uses: actions/checkout@v3

            -   name: Checking PHP Syntax
                uses: TheDragonCode/codestyler@v3
                with:
                    github_token: ${{ secrets.YOUR_TOKEN }}
                    fix: ${{ github.event_name == 'push' && github.ref == 'refs/heads/main' }}

```

### Other CI/CD

```bash
composer global require dragon-code/codestyler

codestyle <command>
```

## Configuration

By default, the linter scans all files in the current launch folder, except for folders such as `vendor`, `node_modules` and `.github`.

```yaml
-   uses: TheDragonCode/codestyler@v3
```

By default, the linter only checks the code-style. If you want to apply the changes, then you need to activate this option:

```yaml
-   uses: TheDragonCode/codestyler@v3
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


[badge_downloads]:  https://img.shields.io/packagist/dt/dragon-code/codestyler.svg?style=flat-square

[badge_license]:    https://img.shields.io/badge/license-MIT-green?style=flat-square

[badge_stable]:     https://img.shields.io/github/v/release/TheDragonCode/codestyler?label=stable&style=flat-square

[badge_unstable]:   https://img.shields.io/badge/unstable-dev--main-orange?style=flat-square

[link_license]:     LICENSE

[link_packagist]:   https://packagist.org/packages/dragon-code/codestyler

[link_repo]:        https://github.com/TheDragonCode/codestyler
