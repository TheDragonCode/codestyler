#!/bin/sh -l

if [[ $(allowFix) == "false" ]]; then
    codestyler check

    exitcode=$?

    exit $exitcode
fi
