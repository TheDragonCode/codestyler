#!/bin/sh -l

IS_DIRTY_NORMALIZE=0
if [[ $(allow "$INPUT_NORMALIZE") == "true" ]]; then
    composer global require ergebnis/composer-normalize

    if [[ -f "./composer.json" ]]; then
        IS_DIRTY_NORMALIZE=1

        { composer normalize && git add composer.json composer.lock && git commit -a -m "🦋 Normalized composer.json"; } || IS_DIRTY_NORMALIZE=0
    fi
fi
