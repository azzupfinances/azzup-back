# PHP-FPM image shared by the app, queue, and scheduler services.
# See docs/infrastructure/docker.md
FROM php:8.4-fpm-alpine

ARG UID=1000
ARG GID=1000

RUN apk add --no-cache icu-libs libpq libzip \
    && apk add --no-cache --virtual .build-deps icu-dev libzip-dev postgresql-dev \
    && docker-php-ext-install bcmath intl opcache pcntl pdo_pgsql zip \
    && apk del .build-deps

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Run as a non-root user matching the host user so bind-mounted files keep host ownership.
RUN addgroup -g "${GID}" app \
    && adduser -D -u "${UID}" -G app app \
    && sed -i '/^user = /d; /^group = /d' /usr/local/etc/php-fpm.d/www.conf

COPY uploads.ini /usr/local/etc/php/conf.d/uploads.ini
COPY entrypoint.sh /usr/local/bin/entrypoint.sh

WORKDIR /var/www/html
USER app

ENTRYPOINT ["entrypoint.sh"]
CMD ["php-fpm"]
