#!/bin/sh -l

composer global thanks

if [ -f "./composer.json" ]; then
    composer thanks
fi
