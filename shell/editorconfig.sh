#!/bin/sh -l

IS_DIRTY_EDITORCONFIG=0

if [[ $(allowFix) == "true" && $(allow "$INPUT_EDITORCONFIG") == "true" ]]; then
    IS_DIRTY_EDITORCONFIG=1

    { codestyler editorconfig && git add . && git commit -a -m "Update \`.editorconfig\` 📖"; } || IS_DIRTY_EDITORCONFIG=0
fi
