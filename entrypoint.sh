#!/bin/sh -l

# Check only
if [[ "$INPUT_FIX" != 'true' && "$INPUT_FIX" != true ]]; then
    php-cs-fixer fix --config=/.php-cs.php --dry-run --diff --ansi
    exitcode=$?

    exit $exitcode
fi

# Check GitHub Token
[ -z "${INPUT_GITHUB_TOKEN}" ] && {
    echo 'Missing input "github_token: ${{ secrets.GITHUB_TOKEN }}".';
    exit 1;
};

# Set git config
git config --local user.email "action@github.com"
git config --local user.name "GitHub Action"

# Copy config file
IS_DIRTY_CONFIG=1

cp -fr /.editorconfig ./.editorconfig

{ git add . && git commit -a -m "Update .editorconfig"; } || IS_DIRTY_CONFIG=0

# Fix codestyle
IS_DIRTY_CODE=1

php-cs-fixer fix --config=/.php-cs.php -v

{ git add . && git commit -a -m "Update code-style"; } || IS_DIRTY_CODE=0

# Push changes
if [[ "$IS_DIRTY_CONFIG" == 1 || "$IS_DIRTY_CODE" == 1 ]]; then git push; fi
