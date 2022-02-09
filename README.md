# PHP CodeStyler

![the dragon code php code styler](https://preview.dragon-code.pro/the-dragon-code/php-code-styler.svg?brand=github&invert=1)

[![Stable Version][badge_stable]][link_repo]
[![Unstable Version][badge_unstable]][link_repo]
[![License][badge_license]][link_license]

## Usage

Create a new `.github/workflows/lint.yml` file and add the content to it:

```yaml
name: Code Style

on: [ push, pull_request ]

jobs:
    check:
        runs-on: ubuntu-latest

        steps:
            -   name: Checkout code
                uses: actions/checkout@v2

            -   name: Checking PHP Syntax
                uses: TheDragonCode/php-codestyler@latest
```

That's all. Now, when pushing and pull-requesting, a linter will be triggered, indicating possible errors.


## Configuration

By default, the linter scans the `src` and `tests` folders, but you can override them.

```yaml
-   uses: TheDragonCode/php-codestyler@v1
    with:
        path: 'foo bar baz'
```

or

```yaml
-   uses: TheDragonCode/php-codestyler@v1
    with:
        path: '.'
```

Also, by default, the linter only checks for compliance without making changes to the files.

If you want to apply changes to repository, then use the following example:

```yaml
-   uses: TheDragonCode/php-codestyler@latest
    with:
        path: 'src tests config resources'
        fix: true
        github_token: ${{ secrets.GITHUB_TOKEN }}
```

## Versionable

Since the GitHub Action system requires you to explicitly specify the version of the container you are using, we created two aliases for convenience:

| Tag    | Alias  | Comment                                                                   |
|--------|--------|---------------------------------------------------------------------------|
| v1.0.0 | v1.0.0 | Explicitly specifying a specific version.                                 |
| v1.0.0 | v1     | Binding to the major version.                                             |
| v1.0.0 | latest | Binding to the most recent release, including changing the major version. |

For example:

| Tag    | Aliases                  |
|--------|--------------------------|
| v2.1.0 | `v2.1.0`, `v2`, `latest` |
| v2.0.0 | `v2.0.0`                 |
| v1.1.0 | `v1.1.0`, `v1`           |
| v1.0.1 | `v1.0.1`                 |
| v1.0.0 | `v1.0.0`                 |

## License

This package is licensed under the [MIT License](LICENSE).


[badge_license]:    https://img.shields.io/badge/license-MIT-green?style=flat-square

[badge_stable]:     https://img.shields.io/github/v/release/TheDragonCode/php-codestyler?label=stable&style=flat-square

[badge_unstable]:   https://img.shields.io/badge/unstable-dev--main-orange?style=flat-square

[link_license]:     LICENSE

[link_repo]:        https://github.com/TheDragonCode/php-codestyler
