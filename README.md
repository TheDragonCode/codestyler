# The Dragon Code Styler

![the dragon code code styler](https://preview.dragon-code.pro/the-dragon-code/code-styler.svg?brand=php&mode=dark)

[![Stable Version][badge_stable]][link_repo]
[![Unstable Version][badge_unstable]][link_repo]
[![Total Downloads][badge_downloads]][link_packagist]
[![License][badge_license]][link_license]

## Introduction

`The Dragon Code Styler` is an opinionated PHP code style fixer for minimalists.
`Codestyler` is built on top of [Laravel Pint](https://laravel.com/docs/pint)
and [PHP-CS-Fixer](https://github.com/PHP-CS-Fixer/PHP-CS-Fixer), and makes it simple to ensure that your code style
stays clean and consistent.

By default, `Codestyler` does not require any configuration and will fix code style issues in your code by following
the opinionated coding style of `The Dragon Code` based on the [`PER`](https://www.php-fig.org/per/coding-style/) rule
set.

## Installation

### Required

- PHP: ^8.1
- Composer: ^2.0

### Locally

```bash
composer global require dragon-code/codestyler
```

## Usage

When you run the commands in the base path of the project, the `composer.json` file will be automatically read, from
which the minimum PHP version for your project will be taken.

This is necessary to draw up rules for applying the Codestyler.

For example, if your project supports PHP 8.0 and above, and you use the `mkdir($path, 0755)` function in it, then
applying the rules for PHP 8.0 will break your code because it
will replace `0755` with `0o755` (`mkdir($path, 0o755)`).

To prevent this from happening, we check the minimum PHP version.

Please note that the `composer.json` file is only read if the script execution is started in the folder with it.

### CLI

```bash
# Check code-style
codestyle --test

# Fix code-style
codestyle

# Update `.editorconfig`
codestyle editorconfig

# Update Dependabot rules
codestyle dependabot

# Publishes code-style settings for the phpStorm IDE
codestyle phpstorm

# Show list of available commands
codestyle list
```

### Options

#### Path

The path to fix

```bash
codestyle foo/bar
```

#### Test

Test for code style errors without fixing them

```bash
codestyle --test
```

#### Config

The configuration that should be used. The target directory will read the `pint.json` file
from [Laravel Pint](https://laravel.com/docs/pint), minus the style set.

```bash
codestyle --config=foo/bar
```

#### Risky

Allows to set whether risky rules may run:

```bash
codestyle --risky --test
codestyle --risky
```

#### Dirty

Only fix files that have uncommitted changes.

```bash
codestyle --dirty
```

#### Bail

Test for code style errors without fixing them and stop on first error

```Bash
codestyle --bail
```

#### Output Format

The output format that should be used.

```bash
codestyle --format
```

List of available formats:

- checkstyle
- gitlab
- json
- junit
- txt
- xml

#### Help Commands

To view the list of available commands, you can call the console command:

```bash
codestyle list
```

To view extended information on a command, you can use the `help` option. For example,

```bash
codestyle --help
codestyle dependabot --help
codestyle editorconfig --help
```

### GitHub Action

> ATTENTION
>
> Starting with code styler version 4.2.0, we will no longer support
> a [container](https://github.com/marketplace/actions/the-dragon-code-styler) for GitHub Actions.
>
> Instead, use direct dependency installation using the examples below.

Create a new `.github/workflows/code-style.yml` file and add the content to it:

```yaml
name: Code Style

on: [ push, pull_request ]

permissions: write-all

jobs:
    check:
        runs-on: ubuntu-latest

        if: ${{ github.event_name != 'push' || github.ref != 'refs/heads/main' }}

        steps:
            -   name: Checkout code
                uses: actions/checkout@v4

            -   name: Setup PHP
                uses: shivammathur/setup-php@v2
                with:
                    extensions: curl, mbstring, zip, pcntl, pdo, pdo_sqlite, iconv, json
                    coverage: none

            -   name: Install dependency
                run: composer global require dragon-code/codestyler

            -   name: Check the code-style
                run: codestyle --test

    fix:
        runs-on: ubuntu-latest

        if: ${{ github.event_name == 'push' && github.ref == 'refs/heads/main' }}

        steps:
            -   name: Checkout code
                uses: actions/checkout@v4

            -   name: Setup PHP
                uses: shivammathur/setup-php@v2
                with:
                    extensions: curl, mbstring, zip, pcntl, pdo, pdo_sqlite, iconv, json
                    coverage: none

            -   name: Setup Composer
                run: |
                    composer global config github-oauth.github.com ${{ secrets.COMPOSER_TOKEN }}

                    composer global config --no-plugins allow-plugins.dragon-code/codestyler true
                    composer global config --no-plugins allow-plugins.ergebnis/composer-normalize true
                    composer global config --no-plugins allow-plugins.symfony/thanks true

                    composer config --no-plugins allow-plugins.dragon-code/codestyler true
                    composer config --no-plugins allow-plugins.ergebnis/composer-normalize true
                    composer config --no-plugins allow-plugins.symfony/thanks true

            -   name: Install dependencies
                run: |
                    composer global require dragon-code/codestyler
                    composer global require ergebnis/composer-normalize
                    composer global require symfony/thanks

            -   name: Fix the code-style
                run: |
                    # Copies the `.editorconfig` file to the folder from which the command is run.
                    # The file contains a complete set of instructions for the IDE that supports EditorConfig.
                    codestyle editorconfig

                    # Copies the `The_Dragon_Code_phpStorm.xml` file to the folder from which the command is run.
                    # The file contains a complete set of instructions for JetBrains PhpStorm.
                    codestyle phpstorm

                    # Creates or updates the `dependabot.yml` file for GitHub Actions.
                    codestyle dependabot

                    # Provides a composer plugin for normalizing `composer.json`.
                    composer normalize

                    # The main script for fixing the project code style
                    codestyle

                    # The easiest and free way to say “thank you” to the developers whose packages
                    you use is to “star” the GitHub repository.
                    # See more at https://github.com/symfony/thanks
                    composer thanks

            -   name: Create a Pull Request
                uses: peter-evans/create-pull-request@v6
                with:
                    branch: code-style
                    branch-suffix: random
                    delete-branch: true
                    title: "🦋 The code style has been fixed"
                    commit-message: 🦋 The code style has been fixed
                    body: The code style has been fixed
                    labels: code-style
```

You can also use a simplified version of the configuration by linking to our settings.

In this case, the following settings will be applied:

- Always checks if the event is not equal to `push` or the branch is not equal to `main`
- Correcting the code style will take the following steps:
    - Will add the following plugins to the list
      of [allowed plugins](https://getcomposer.org/doc/06-config.md#allow-plugins)
      in your `composer.json` file:
        - `dragon-code/codestyler`
        - `ergebnis/composer-normalize`
        - `symfony/thanks`
    - Updates the `.github/dependabot.yml` file
    - Updates the `.editorconfig` file
    - Will correct the order of elements in the `composer.json` file to match
      the [official schema](https://github.com/composer/composer/blob/main/res/composer-schema.json).
    - Corrects the code style of your project.

```yml
name: Code Style

on: [ push, pull_request ]

permissions: write-all

jobs:
    check:
        uses: TheDragonCode/.github/.github/workflows/code-style.yml@main
```

### Other CI/CD

```bash
composer global require dragon-code/codestyler

codestyle <command>
```

### IDE

After executing the `codestyle editorconfig` console command, a `.editorconfig` file will be added to your application.
If the file already exists, it will be replaced.

In order for your IDE to read the code style settings from it, make sure its support is enabled in the settings.

For example, in `phpStorm` the setting is in
the [File | Settings | Editor | Code Style](jetbrains://PhpStorm/settings?name=Editor--Code+Style):

![image](https://github.com/TheDragonCode/codestyler/assets/10347617/0a0ac61e-f297-41c9-b034-4ae52ea96da6)

You can also use the `codestyle phpstorm` console command to publish the schema xml file to phpStorm.
You can import this file into the IDE.

## License

This package is licensed under the [MIT License](LICENSE).


[badge_downloads]:  https://img.shields.io/packagist/dt/dragon-code/codestyler.svg?style=flat-square

[badge_license]:    https://img.shields.io/badge/license-MIT-green?style=flat-square

[badge_stable]:     https://img.shields.io/github/v/release/TheDragonCode/codestyler?label=stable&style=flat-square

[badge_unstable]:   https://img.shields.io/badge/unstable-dev--main-orange?style=flat-square

[link_license]:     LICENSE

[link_packagist]:   https://packagist.org/packages/dragon-code/codestyler

[link_repo]:        https://github.com/TheDragonCode/codestyler
