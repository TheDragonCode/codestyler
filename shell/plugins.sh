#!/bin/sh -l

IS_PLUGINS_CONFIG=1

composer global config --no-plugins allow-plugins.dragon-code/codestyler true
composer global config --no-plugins allow-plugins.ergebnis/composer-normalize true
composer global config --no-plugins allow-plugins.symfony/thanks true

composer config --no-plugins allow-plugins.dragon-code/codestyler true

{ git add composer.json composer.lock && git commit -a -m "💂 Updated permissions to run code styler"; } || IS_PLUGINS_CONFIG=0
