#!/bin/sh -l

if [[ $(allowFix) == "false" ]]; then
    ls -l
    
    codestyle check --ansi

    exitcode=$?

    exit $exitcode
fi
