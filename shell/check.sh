#!/bin/sh -l

if [[ $(allowFix) == "false" ]]; then
    cd ~/.composer/vendor/bin && ls -l
    
    codestyle check --ansi

    exitcode=$?

    exit $exitcode
fi
