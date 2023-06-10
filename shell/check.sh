#!/bin/sh -l

if [[ $(allowFix) == "false" ]]; then
    if [[ $INPUT_VERBOSE == "true" ]]; then
        codestyle --test --verbose
    else
        codestyle --test
    fi

    exitcode=$?

    exit $exitcode
fi
