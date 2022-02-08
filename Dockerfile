ARG PHP_VERSION=8.1

FROM composer:2.0 AS build
RUN composer global require dragon-code/codestyler

FROM php:${PHP_VERSION}-cli-alpine
COPY --from=build /tmp/vendor /root/.composer/vendor
COPY entrypoint.sh /entrypoint.sh
RUN chmod +x /entrypoint.sh
RUN cp /usr/local/etc/php/php.ini-development /usr/local/etc/php/php.ini

WORKDIR /workdir
ENTRYPOINT ["/entrypoint.sh"]
