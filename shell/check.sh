#!/bin/sh -l

if [[ $(allowFix) == "false" ]]; then
    echo "Check the code style..."
    php codestyle --test

    exitcode=$?

    exit $exitcode
fi
