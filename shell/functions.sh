#!/bin/sh -l

function allow() {
    local result="false"

    if [[ "$1" == "true" || "$1" == "1" ]]; then
        result="true"
    fi

    echo "$result"
}

function allowFix() {
    local result="false"

    if [[ "$(allow "$INPUT_FIX")" == "true" ]]; then
        result="true"
    fi

    echo "$result"
}
