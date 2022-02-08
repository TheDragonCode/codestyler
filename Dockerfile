ARG PHP_VERSION=8.1

FROM helldar/laravel-gitlab-ci:${PHP_VERSION}

ARG INPUT_PATH
ARG INPUT_FIX

RUN composer global require dragon-code/codestyler

COPY entrypoint.sh /entrypoint.sh
RUN chmod +x /entrypoint.sh

ENTRYPOINT ["/entrypoint.sh"]
