#!/bin/sh -l

if [[ $(allowFix) == "false" ]]; then
    cd ~
    ls -l
    
    codestyle check --ansi

    exitcode=$?

    exit $exitcode
fi
