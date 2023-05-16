#!/bin/sh -l

if [[ $(allowFix) == "false" ]]; then
    cd ~/.composer/vendor && ls -l
    
    codestyle check --ansi

    exitcode=$?

    exit $exitcode
fi
