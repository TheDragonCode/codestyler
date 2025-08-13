# The Dragon Code Styler

![the dragon code code styler](https://preview.dragon-code.pro/the-dragon-code/code-styler.svg?brand=php&mode=dark)

[![Stable Version][badge_stable]][link_repository]
[![Total Downloads][badge_downloads]][link_packagist]
[![License][badge_license]][link_license]

> [!NOTE]
>
> `Codestyler 5` is the last version that runs on its own code and includes a mechanism for publishing files via command
> parameters. It is also the last version installed globally via Composer.
>
> Starting with `Codestyler 6`, the project will contain `pint.json` and `.editorconfig` files, and adding them to the
> project will be done by calling a console command.

## Installation

You can install the package using [Composer](https://getcomposer.org):

```bash
composer require dragon-code/codestyler --dev

composer config scripts.style "vendor/bin/pint --parallel"
```

It is also possible to establish dependence in the global area of visibility:

```bash
composer global require dragon-code/codestyler
```

After installing the dependency, add a file copy command to the `scripts.post-update-cmd` section.
This will automatically copy the `pint.json` file to the project root.

When adding the command, replace `8.4` with the minimum PHP version your application works with.
Available presets: `8.2`, `8.3` and `8.4`.

You can also add copying the `.editorconfig` file to help the IDE and calling normalize the `composer.json` file:

```json
{
    "scripts": {
        "post-update-cmd": [
            "vendor/bin/codestyle pint 8.4",
            "vendor/bin/codestyle editorconfig",
            "composer normalize"
        ]
    }
}
```

## Usage

### Linter

Laravel Pint is used as the linker. Documentation for working with it can be
found [here](https://laravel.com/docs/pint).

The linter is invoked by a console command:

```bash
composer style
```

### EditorConfig

The `.editorconfig` file helps your IDE to work according to certain rules.

To do this, make sure the file is in the root of the project.
You can also automate this process by adding a call to the file copy function in the `scripts.post-update-cmd`
section of the `composer.json` file.

```JSON
{
    "scripts": {
        "post-update-cmd": [
            "vendor/bin/codestyle editorconfig"
        ]
    }
}
```

### Composer Normalize

We recommend using the [Composer Normalize](https://github.com/ergebnis/composer-normalize) plugin,
which normalizes the `composer.json` file appearance to match its schema.
This will keep each project's file consistent, making it much easier to read.

To activate the plugin, call the console command:

```bash
composer config allow-plugins.ergebnis/composer-normalize true
```

To use this feature, add a call parameter to the `post-update-cmd` block of the `composer.json` file:

```JSON
{
    "scripts": {
        "post-update-cmd": [
            "composer normalize"
        ]
    }
}
```

Now you can just a run console command:

```bash
composer update
```

### Finalized `composer.json`

After completing all the steps, the `composer.json` file will have the following changes:

```json
{
    "require-dev": {
        "dragon-code/codestyler": "^6.0"
    },
    "config": {
        "allow-plugins": {
            "ergebnis/composer-normalize": true
        }
    },
    "scripts": {
        "post-update-cmd": [
            "vendor/bin/codestyle pint 8.4",
            "vendor/bin/codestyle editorconfig",
            "composer normalize"
        ],
        "style": "vendor/bin/pint --parallel"
    }
}

```

### IDE

After executing the `composer update` console command, a `.editorconfig` file will be added to your application.
If the file already exists, it will be replaced.

In order for your IDE to read the code style settings from it, make sure its support is enabled in the settings.

For example, in `phpStorm` the setting is in
the [File | Settings | Editor | Code Style](jetbrains://PhpStorm/settings?name=Editor--Code+Style):

![image](https://github.com/TheDragonCode/codestyler/assets/10347617/0a0ac61e-f297-41c9-b034-4ae52ea96da6)

## License

This package is licensed under the [MIT License](LICENSE).


[badge_downloads]:  https://img.shields.io/packagist/dt/dragon-code/codestyler.svg?style=flat-square

[badge_license]:    https://img.shields.io/badge/license-MIT-green?style=flat-square

[badge_stable]:     https://img.shields.io/github/v/release/TheDragonCode/codestyler?label=stable&style=flat-square

[link_license]:     LICENSE

[link_packagist]:   https://packagist.org/packages/dragon-code/codestyler

[link_repository]:  https://github.com/TheDragonCode/codestyler
