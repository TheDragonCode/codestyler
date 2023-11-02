#!/bin/sh -l

IS_DIRTY_EDITORCONFIG=0

if [[ $(allow "$INPUT_EDITORCONFIG") == "true" ]]; then
    IS_DIRTY_EDITORCONFIG=1

    if [[ $INPUT_VERBOSE == "true" ]]; then
        codestyle editorconfig --verbose
    else
        codestyle editorconfig
    fi

    { git add .editorconfig && git commit -a -m "📖 Updated .editorconfig file"; } || IS_DIRTY_EDITORCONFIG=0
fi
