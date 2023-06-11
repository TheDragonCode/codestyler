#!/bin/sh -l

IS_DIRTY_CODE=1

if [[ $INPUT_VERBOSE == "true" ]]; then
    codestyle --verbose
else
    codestyle
fi

{ git add . && git commit -a -m "🧹 Fixed code-style"; } || IS_DIRTY_CODE=0
