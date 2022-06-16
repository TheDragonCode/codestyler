ARG PHP_VERSION=8.1

FROM helldar/laravel-gitlab-ci:${PHP_VERSION}

ARG INPUT_FIX
ARG INPUT_GITHUB_TOKEN
ARG INPUT_EDITORCONFIG
ARG INPUT_DEPENDABOT
ARG INPUT_NORMALIZE

RUN composer global require dragon-code/codestyler:^2.1

COPY shell /shell
COPY entrypoint.sh /entrypoint.sh
RUN chmod +x /entrypoint.sh

ENTRYPOINT ["/entrypoint.sh"]
