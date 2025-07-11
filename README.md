# The Dragon Code Styler

![the dragon code code styler](https://preview.dragon-code.pro/the-dragon-code/code-styler.svg?brand=php&mode=dark)

[![Stable Version][badge_stable]][link_repo]
[![Total Downloads][badge_downloads]][link_packagist]
[![License][badge_license]][link_license]

## Introduction

`The Dragon Code Styler` is an opinionated PHP code style fixer for minimalists.
`Codestyler` is built on top of [Laravel Pint](https://laravel.com/docs/pint)
and [PHP-CS-Fixer](https://github.com/PHP-CS-Fixer/PHP-CS-Fixer), and makes it simple to ensure that your code style
stays clean and consistent.

By default, `Codestyler` does not require any configuration and will fix code style issues in your code by following
the opinionated coding style of `The Dragon Code` based on the [`PER-2.0`](https://www.php-fig.org/per/coding-style/) rule
set.


> The easiest and free way to say “thank you” to the developers whose packages
> you use is to “star” the GitHub repository.
>
> See more at https://github.com/symfony/thanks


## Installation

### Required

| Package | PHP       |
|---------|-----------|
| `^5.0`  | 8.2 - 8.4 |
| `^4.0`  | 8.1 - 8.3 |

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

# Also you can run parallel styling
codestyle --parallel

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

### CI/CD

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

[link_license]:     LICENSE

[link_packagist]:   https://packagist.org/packages/dragon-code/codestyler

[link_repo]:        https://github.com/TheDragonCode/codestyler
