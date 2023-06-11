#!/bin/sh -l

[ ! -z "${INPUT_GITHUB_TOKEN}" ] && {
    if [[ -f "./composer.json" ]]; then
        composer global require symfony/thanks

        composer thanks
    fi
};
