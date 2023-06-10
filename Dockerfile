FROM helldar/laravel-gitlab-ci:stable

LABEL maintainer="Andrey Helldar"

ARG INPUT_FIX
ARG INPUT_GITHUB_TOKEN
ARG INPUT_EDITORCONFIG
ARG INPUT_DEPENDABOT
ARG INPUT_NORMALIZE

RUN composer global require dragon-code/codestyler:^3.4

COPY shell /shell
COPY entrypoint.sh /entrypoint.sh
RUN chmod +x /entrypoint.sh

ENTRYPOINT ["/entrypoint.sh"]
