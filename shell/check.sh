#!/bin/sh -l

if [[ $(allowFix) == "false" ]]; then
    codestyle check

    exitcode=$?

    exit $exitcode
fi
