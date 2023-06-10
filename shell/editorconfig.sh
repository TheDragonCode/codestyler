#!/bin/sh -l

IS_DIRTY_EDITORCONFIG=0

if [[ $(allow "$INPUT_EDITORCONFIG") == "true" ]]; then
    IS_DIRTY_EDITORCONFIG=1

    { codestyle editorconfig && git add .editorconfig && git commit -a -m "📖 Update .editorconfig file"; } || IS_DIRTY_EDITORCONFIG=0
fi
