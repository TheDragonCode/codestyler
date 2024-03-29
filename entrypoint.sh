#!/bin/sh -l

export PATH="$HOME/.composer/vendor/bin:~/.composer/vendor/bin:./vendor/bin:/vendor/bin:/composer/vendor/bin:$HOME/.composer/vendor/bin:/var/www/vendor/bin:$HOME/.local/composer/vendor/bin:$COMPOSER_HOME/vendor/bin:$PATH"

source /shell/functions.sh
source /shell/config.sh
source /shell/plugins.sh

if [[ $(allowFix) == "true" ]]; then
    source /shell/editorconfig.sh
    source /shell/dependabot.sh
    source /shell/normalize.sh
    source /shell/fix.sh
    source /shell/thanks.sh

    source /shell/push.sh
else
    source /shell/check.sh
fi
