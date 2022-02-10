#!/bin/sh -l

IS_DIRTY_DEPENDABOT=0

if [[ $(allowFix) == "true" && $(allow "$INPUT_DEPENDABOT") == "true" ]]; then
    IS_DIRTY_DEPENDABOT=1

    { codestyler dependabot && git add . && git commit -a -m "Update Dependabot 🤖"; } || IS_DIRTY_DEPENDABOT=0
fi
