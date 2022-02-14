#!/bin/sh -l

IS_DIRTY_NORMALIZE=0
if [[ $(allowFix) == "true" && $(allow "$INPUT_NORMALIZE") == "true" ]]; then
    composer global require ergebnis/composer-normalize

    if [[ -f "./composer.json" ]]; then
        IS_DIRTY_NORMALIZE=1

        composer global config --no-plugins allow-plugins.ergebnis/composer-normalize true

        { composer normalize && git add . && git commit -a -m "Normalize \`composer.json\` 👀"; } || IS_DIRTY_NORMALIZE=0
    fi
fi
