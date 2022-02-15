#!/bin/sh -l

IS_DIRTY_NORMALIZE=0
if [[ $(allow "$INPUT_NORMALIZE") == "true" ]]; then
    composer global require ergebnis/composer-normalize

    if [[ -f "./composer.json" ]]; then
        IS_DIRTY_NORMALIZE=1

        composer global config --no-plugins allow-plugins.ergebnis/composer-normalize true

        { composer normalize --ansi && git add . && git commit -a -m "Normalize \`composer.json\` 👀"; } || IS_DIRTY_NORMALIZE=0
    fi
fi
