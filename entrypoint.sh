#!/bin/sh -l

isTrue() {
    if [[ "$1" == 'true' || "$1" == true || "$1" == 1 || "$1" == "1" ]]; then
        return 1
    fi

    return 0
}

isFalse() {
    if [ $(isTrue "$1") == 0 ]; then
        return 1
    fi

    return 0
}

# Check only
if [[ $(isFalse "$INPUT_FIX") ]]; then
    codestyler check
    exitcode=$?

    exit $exitcode
fi

# Check GitHub Token
[ -z "${INPUT_GITHUB_TOKEN}" ] && {
    echo 'Missing input "github_token: ${{ secrets.GITHUB_TOKEN }}".';
    #exit 1;
};

# Set git config
git config --local user.email "action@github.com"
git config --local user.name "GitHub Action"

# Copy config file
IS_DIRTY_CONFIG=$INPUT_EDITORCONFIG
{ $(isTrue "$INPUT_EDITORCONFIG") && codestyler editorconfig && git add . && git commit -a -m "Update .editorconfig"; } || IS_DIRTY_CONFIG=0

# Set dependabot
IS_DIRTY_DEPENDABOT=$INPUT_DEPENDABOT
{ $(isTrue "$INPUT_DEPENDABOT") && codestyler dependabot && git add . && git commit -a -m "Enabled dependabot"; } || IS_DIRTY_DEPENDABOT=0

# Fix codestyle
IS_DIRTY_CODE=$INPUT_FIX

if [[ $(isTrue "$INPUT_FIX") ]]; then
    codestyler fix

    { git add . && git commit -a -m "Update code-style"; } || IS_DIRTY_CODE=0
fi

# Push changes
if [[ $(isTrue $IS_DIRTY_CONFIG) || $(isTrue $IS_DIRTY_DEPENDABOT) || $(isTrue $IS_DIRTY_CODE) == 1 ]]; then git push; fi
