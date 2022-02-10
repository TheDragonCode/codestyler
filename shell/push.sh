#!/bin/sh -l

if [[ [$(allowFix) == "true"] && ["$IS_DIRTY_DEPENDABOT" == "1" || "$IS_DIRTY_EDITORCONFIG" == "1" || "$IS_DIRTY_CODE" == "1"] ]]; then
     git push
fi
