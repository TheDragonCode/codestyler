#!/bin/sh -l

[ ! -z "${INPUT_GITHUB_TOKEN}" ] && {
    if [[ -f "./composer.json" ]]; then
        composer global require symfony/thanks

        composer config --no-plugins allow-plugins.symfony/thanks true

        composer thanks
    fi
};
