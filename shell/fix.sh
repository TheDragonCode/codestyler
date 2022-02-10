#!/bin/sh -l

IS_DIRTY_CODE=0

if [[ $(allowFix) == "true" ]]; then
    IS_DIRTY_CODE=1

    codestyler fix

    { git add . && git commit -a -m "Update code-style 💻"; } || IS_DIRTY_CODE=0
fi
