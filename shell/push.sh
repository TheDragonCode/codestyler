#!/bin/sh -l

function isDirty() {
    local result="false"

    if [[ $(allowFix) == "true" ]]; then
        if [[ "$IS_DIRTY_DEPENDABOT" == "1" || "$IS_DIRTY_EDITORCONFIG" == "1" || "$IS_DIRTY_CODE" == "1" || "$IS_DIRTY_NORMALIZE" == "1" ]]; then
            result="true"
        fi
    fi

    echo "$result"
}

if [[ $(allowFix) == "true" && $(isDirty) == "true" ]]; then
    git push
fi
