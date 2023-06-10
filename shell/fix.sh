#!/bin/sh -l

IS_DIRTY_CODE=1

echo "Fix the code style..."

codestyle

{ git add . && git commit -a -m "🧹 Fixed style code"; } || IS_DIRTY_CODE=0
