#!/bin/sh -l

IS_DIRTY_CODE=1

codestyle fix --ansi

{ git add . && git commit -a -m "Update code-style 💻"; } || IS_DIRTY_CODE=0
