#!/bin/sh -l

composer global require symfony/thanks

composer global config --no-plugins allow-plugins.symfony/thanks true

composer global thanks

if [[ -f "./composer.json" ]]; then
    composer config --no-plugins allow-plugins.symfony/thanks true

    composer thanks
fi
