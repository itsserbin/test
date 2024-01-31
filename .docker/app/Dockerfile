FROM php:8.3-fpm-alpine

RUN \
    apk update && apk add --no-cache \
        libjpeg-turbo-dev \
        postgresql-dev \
        libpng-dev \
        libzip-dev \
        libwebp-dev \
        wget \
        zip \
        unzip \
        git && \
    docker-php-ext-install pdo_pgsql && \
    docker-php-ext-install bcmath && \
    docker-php-ext-install gd && \
    docker-php-ext-install zip && \
    docker-php-ext-configure gd \
        --enable-gd \
        --with-jpeg \
        --with-webp && \
    docker-php-ext-install -j$(nproc) gd && \
    wget https://getcomposer.org/composer-stable.phar -O /usr/local/bin/composer && \
    chmod +x /usr/local/bin/composer

COPY .docker/app/php.ini /usr/local/etc/php/conf.d/php.ini
WORKDIR /var/www/backend
