ARG PHP_VERSION=edge

FROM helldar/laravel-gitlab-ci:${PHP_VERSION}

ARG INPUT_FIX
ARG INPUT_GITHUB_TOKEN
ARG INPUT_EDITORCONFIG
ARG INPUT_DEPENDABOT
ARG INPUT_NORMALIZE

# Export composer vendor path
RUN echo "" >> ~/.bashrc && \
    echo 'export PATH="$HOME/.composer/vendor/bin:$PATH"' >> ~/.bashrc

RUN composer global update
RUN composer global require dragon-code/codestyler:^3.3

COPY shell /shell
COPY entrypoint.sh /entrypoint.sh
RUN chmod +x /entrypoint.sh

ENTRYPOINT ["/entrypoint.sh"]
