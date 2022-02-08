#!/bin/sh -l

canFix=''

if [[ "$INPUT_FIX" != 'true' && "$INPUT_FIX" != true ]]; then
    canFix='--dry-run --diff'
fi

php-cs-fixer fix $INPUT_PATH --config=/composer/vendor/dragon-code/codestyler/.php-cs.php $canFix -v
