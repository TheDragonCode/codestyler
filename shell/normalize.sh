#!/bin/sh -l

IS_DIRTY_NORMALIZE=0

if [[ $(allowFix) == "true" && $(allow "$INPUT_NORMALIZE") == "true" ]]; then
    composer global require ergebnis/composer-normalize

    if [[ -f "./composer.json" ]]; then
        IS_DIRTY_NORMALIZE=1

        if [[ $INPUT_VERBOSE == "true" ]]; then
            composer update --verbose
            composer normalize --verbose
        else
            composer update
            composer normalize
        fi

        { git add composer.json composer.lock && git commit -a -m "🦋 Normalized composer.json"; } || IS_DIRTY_NORMALIZE=0
    fi
fi
