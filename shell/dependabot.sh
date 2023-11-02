#!/bin/sh -l

IS_DIRTY_DEPENDABOT=0

if [[ $(allow "$INPUT_DEPENDABOT") == "true" ]]; then
    IS_DIRTY_DEPENDABOT=1

    if [[ $INPUT_VERBOSE == "true" ]]; then
        codestyle dependabot --verbose
    else
        codestyle dependabot
    fi

    { git add .github/dependabot.yml && git commit -a -m "🔄️ Updated Dependabot rules"; } || IS_DIRTY_DEPENDABOT=0
fi
