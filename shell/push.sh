#!/bin/sh -l

function isDirty() {
    local result="false"

    if [[ "$IS_DIRTY_DEPENDABOT" == "1" || "$IS_DIRTY_EDITORCONFIG" == "1" || "$IS_DIRTY_CODE" == "1" || "$IS_DIRTY_NORMALIZE" == "1" || "$IS_PLUGINS_CONFIG" == "1" ]]; then
        result="true"
    fi

    echo "$result"
}

echo "=========================="
echo "=    Changes Detector    ="
echo "=========================="
echo " "
echo "Plugins Config: $IS_PLUGINS_CONFIG"
echo "Dependabot:     $IS_DIRTY_DEPENDABOT"
echo "EditorConfig:   $IS_DIRTY_EDITORCONFIG"
echo "Composer:       $IS_DIRTY_NORMALIZE"
echo "Code Style:     $IS_DIRTY_CODE"
echo " "
echo "Total dirty is $(isDirty)"
echo " "

if [[ $(isDirty) == "true" ]]; then
    git push
fi
