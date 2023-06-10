#!/bin/sh -l

IS_DIRTY_DEPENDABOT=0

if [[ $(allow "$INPUT_DEPENDABOT") == "true" ]]; then
    IS_DIRTY_DEPENDABOT=1

    echo "Update Dependabot rules..."
    { php codestyle dependabot && git add .github/dependabot.yml && git commit -a -m "🔄️ Update Dependabot rules"; } || IS_DIRTY_DEPENDABOT=0
fi
