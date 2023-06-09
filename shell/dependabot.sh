#!/bin/sh -l

IS_DIRTY_DEPENDABOT=0

if [[ $(allow "$INPUT_DEPENDABOT") == "true" ]]; then
    IS_DIRTY_DEPENDABOT=1

    { codestyle dependabot && git add .github/dependabot.yml && git commit -a -m "🔄️ Updated Dependabot rules"; } || IS_DIRTY_DEPENDABOT=0
fi
