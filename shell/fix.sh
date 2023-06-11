#!/bin/sh -l

IS_DIRTY_CODE=0

if [[ $(allowFix) == "true" ]]; then
    if [[ $INPUT_VERBOSE == "true" ]]; then
        codestyle --verbose
    else
        codestyle
    fi
    
    { git add . && git commit -a -m "🧹 Fixed code-style"; } || IS_DIRTY_CODE=0
fi
