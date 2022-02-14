#!/bin/sh -l

IS_DIRTY_DEPENDABOT=0

if [[ $(allow "$INPUT_DEPENDABOT") == "true" ]]; then
    IS_DIRTY_DEPENDABOT=1

    { codestyle dependabot && git add . && git commit -a -m "Update Dependabot 🤖"; } || IS_DIRTY_DEPENDABOT=0
fi
