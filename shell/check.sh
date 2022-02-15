#!/bin/sh -l

if [[ $(allowFix) == "false" ]]; then
    codestyle check --ansi

    exitcode=$?

    exit $exitcode
fi
