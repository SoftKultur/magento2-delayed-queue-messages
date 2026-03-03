FROM php:8.1-fpm-alpine AS base

RUN apk add --update --no-cache \
    unzip \
    zlib-dev \
    libzip-dev \
    icu-dev \
    freetype icu \
    libxml2-dev \
    libpng-dev \
    openssl-dev

RUN apk add --update --no-cache \
    libxslt-dev

RUN docker-php-ext-install intl zip bcmath xml gd ftp \
    && docker-php-ext-enable bcmath xml gd ftp

RUN docker-php-ext-install xsl

RUN rm -rf /var/cache/apk/* \
    /var/lib/apt/lists/*

COPY docker/php.ini /usr/local/etc/php/conf.d/zz-php.ini

COPY docker/entrypoint.sh /app/entrypoint.sh

COPY --from=docker.io/library/composer /usr/bin/composer /usr/bin/composer

EXPOSE 9000

STOPSIGNAL SIGQUIT
ENTRYPOINT ["/bin/sh", "/app/entrypoint.sh"]