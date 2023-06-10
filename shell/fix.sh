#!/bin/sh -l

IS_DIRTY_CODE=1

echo "Fix the code style..."

php codestyle

{ git add . && git commit -a -m "🧹 Fix style code"; } || IS_DIRTY_CODE=0
