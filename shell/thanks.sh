#!/bin/sh -l

if [[ ! -z "${INPUT_GITHUB_TOKEN}" ]]; then
    if [[ -f "./composer.json" ]]; then
            composer global require symfony/thanks
    
            composer thanks
        fi
fi
