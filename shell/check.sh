#!/bin/sh -l

if [[ $(allowFix) == "false" ]]; then
    codestyle --test

    exitcode=$?

    exit $exitcode
fi
