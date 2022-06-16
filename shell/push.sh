#!/bin/sh -l

function isDirty() {
    local result="false"

    if [[ "$IS_DIRTY_DEPENDABOT" == "1" || "$IS_DIRTY_EDITORCONFIG" == "1" || "$IS_DIRTY_CODE" == "1" || "$IS_DIRTY_NORMALIZE" == "1" || "$IS_PLUGINS_CONFIG" == "1" ]]; then
        result="true"
    fi

    echo "$result"
}

if [[ $(isDirty) == "true" ]]; then
    git push
fi
