#!/bin/sh -l

set -ex

if [ ! -z "$INPUT_PATH" ]; then
  /root/.composer/vendor/bin/codestyler $INPUT_PATH $INPUT_OPTIONS
else
  sh -c "/root/.composer/vendor/bin/codestyler $*"
fi
