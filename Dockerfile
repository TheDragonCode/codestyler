FROM helldar/laravel-gitlab-ci:stable

LABEL maintainer="Andrey Helldar"

ARG INPUT_FIX
ARG INPUT_GITHUB_TOKEN
ARG INPUT_EDITORCONFIG
ARG INPUT_DEPENDABOT
ARG INPUT_NORMALIZE
ARG INPUT_VERBOSE

RUN composer global require dragon-code/codestyler:^4.0

RUN echo "!!! ATTENTION !!!"
RUN echo " "
RUN echo "Starting with code styler version 4.2.0, we will no longer support a that container."
RUN echo " "
RUN echo "Use direct dependency installation instead."
RUN echo "You can read more detailed information in the project README file."

COPY shell /shell
COPY entrypoint.sh /entrypoint.sh
RUN chmod +x /entrypoint.sh

ENTRYPOINT ["/entrypoint.sh"]
