ARG PHP_VERSION=8.1

FROM helldar/laravel-gitlab-ci:${PHP_VERSION}

ARG INPUT_PATH
ARG INPUT_FIX
ARG INPUT_GITHUB_TOKEN

RUN composer global require friendsofphp/php-cs-fixer

COPY entrypoint.sh /entrypoint.sh
RUN chmod +x /entrypoint.sh

COPY .php-cs.php /.php-cs.php

ENTRYPOINT ["/entrypoint.sh"]
