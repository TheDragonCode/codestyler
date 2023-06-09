#!/bin/sh -l

IS_DIRTY_CODE=1

codestyle

{ git add . && git commit -a -m "🧹 Fixed style code"; } || IS_DIRTY_CODE=0
