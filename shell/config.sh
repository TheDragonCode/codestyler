#!/bin/sh -l

# Check GitHub Token
[ -z "${INPUT_GITHUB_TOKEN}" ] && {
    echo 'Missing input "github_token".';

    exit 1;
};

# Set git config
git config --global user.email "action@github.com"
git config --global user.name "GitHub Action"

# Set safe directory
git config --global --add safe.directory /github/workspace
