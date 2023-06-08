#!/bin/sh -l

IS_PLUGINS_CONFIG=1

composer global config --no-plugins allow-plugins.dragon-code/codestyler true
composer global config --no-plugins allow-plugins.ergebnis/composer-normalize true

composer config --no-plugins allow-plugins.dragon-code/codestyler true
composer config --no-plugins allow-plugins.ergebnis/composer-normalize true

{ git add composer.json && git commit -a -m "💂 Updated permissions to run plugins"; } || IS_PLUGINS_CONFIG=0
