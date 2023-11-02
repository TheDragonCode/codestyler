#!/bin/sh -l

if [[ $INPUT_VERBOSE == "true" ]]; then
    codestyle --test --verbose
else
    codestyle --test
fi

exitcode=$?

exit $exitcode
