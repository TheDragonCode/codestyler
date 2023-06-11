#!/bin/sh -l

IS_PLUGINS_CONFIG=1

[ ! -z "${INPUT_GITHUB_TOKEN}" ] && {
    composer global config github-oauth.github.com ${INPUT_GITHUB_TOKEN}
};

composer global config --no-plugins allow-plugins.dragon-code/codestyler true
composer global config --no-plugins allow-plugins.ergebnis/composer-normalize true
composer global config --no-plugins allow-plugins.symfony/thanks true

composer config --no-plugins allow-plugins.dragon-code/codestyler true
composer config --no-plugins allow-plugins.ergebnis/composer-normalize true
composer config --no-plugins allow-plugins.symfony/thanks true

{ git add composer.json composer.lock && git commit -a -m "💂 Updated permissions to run plugins"; } || IS_PLUGINS_CONFIG=0
