#!/bin/sh -l

IS_DIRTY_NORMALIZE=0

if [[ $(allow "$INPUT_NORMALIZE") == "true" ]]; then
    composer global require ergebnis/composer-normalize

    composer config --no-plugins allow-plugins.ergebnis/composer-normalize true

    if [[ -f "./composer.json" ]]; then
        IS_DIRTY_NORMALIZE=1

        if [[ $INPUT_VERBOSE == "true" ]]; then
            composer normalize --verbose
        else
            composer normalize
        fi

        { git add composer.json composer.lock && git commit -a -m "🦋 Normalized composer.json"; } || IS_DIRTY_NORMALIZE=0
    fi
fi
