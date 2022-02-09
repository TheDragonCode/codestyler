#!/bin/sh -l

canFix=''

if [[ "$INPUT_FIX" != 'true' && "$INPUT_FIX" != true ]]; then
    canFix='--dry-run --diff'
else
    [ -z "${INPUT_GITHUB_TOKEN}" ] && {
        echo 'Missing input "github_token: ${{ secrets.GITHUB_TOKEN }}".';
        exit 1;
    };
fi

## Fix codestyle
php-cs-fixer fix $INPUT_PATH --config=/.php-cs.php $canFix -v

# Commit and push changes
if [[ "$INPUT_FIX" == 'true' && "$INPUT_FIX" == true ]]; then
    git config --local user.email "action@github.com"
    git config --local user.name "GitHub Action"

    IS_DIRTY=1

    { git add . && git commit -a -m "Codestyle fix"; } || IS_DIRTY=0

    if [ "$IS_DIRTY" == 1 ]; then git push; fi
fi
