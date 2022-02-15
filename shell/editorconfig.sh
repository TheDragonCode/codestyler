#!/bin/sh -l

IS_DIRTY_EDITORCONFIG=0

if [[ $(allow "$INPUT_EDITORCONFIG") == "true" ]]; then
    IS_DIRTY_EDITORCONFIG=1

    { codestyle editorconfig --ansi && git add . && git commit -a -m "Update \`.editorconfig\` 📖"; } || IS_DIRTY_EDITORCONFIG=0
fi
