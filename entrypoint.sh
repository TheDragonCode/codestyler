#!/bin/sh -l

export PATH="$HOME/.composer/vendor/bin:~/.composer/vendor/bin:./vendor/bin:/vendor/bin:/composer/vendor/bin:$HOME/.composer/vendor/bin:/var/www/vendor/bin:$HOME/.local/composer/vendor/bin:$COMPOSER_HOME/vendor/bin:$PATH"

source /shell/functions.sh
source /shell/config.sh
source /shell/plugins.sh

source /shell/check.sh
source /shell/fix.sh
source /shell/editorconfig.sh
source /shell/dependabot.sh
source /shell/normalize.sh
source /shell/thanks.sh

source /shell/push.sh
