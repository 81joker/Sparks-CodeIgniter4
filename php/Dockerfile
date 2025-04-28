FROM php:8.2-fpm-alpine

# Install essential build tools and libraries
RUN apk add --no-cache \
    bash \
    mysql-client \
    mariadb-connector-c-dev \
    libpng-dev \
    libzip-dev \
    zip \
    unzip \
    icu-dev \
    freetype-dev \
    libjpeg-turbo-dev \
    libwebp-dev

# Configure and install PHP extensions
RUN docker-php-ext-configure gd --with-freetype --with-jpeg --with-webp && \
    docker-php-ext-install -j$(nproc) \
    pdo \
    pdo_mysql \
    mysqli \
    gd \
    zip \
    intl \
    opcache

# Install Composer
ENV COMPOSER_ALLOW_SUPERUSER=1
COPY --from=composer:2.4 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html


# COPY upload-limit.ini /usr/local/etc/php/conf.d/
