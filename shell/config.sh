#!/bin/sh -l

# Check GitHub Token
[ -z "${INPUT_GITHUB_TOKEN}" ] && {
    echo 'Missing input "github_token: ${{ secrets.GITHUB_TOKEN }}".';

    exit 1;
};

# Set git config
git config --local user.email "action@github.com"
git config --local user.name "GitHub Action"
