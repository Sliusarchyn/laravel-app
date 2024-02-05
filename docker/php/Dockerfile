FROM php:8.2-fpm-alpine

COPY docker/php/php.ini "$PHP_INI_DIR/php.ini"

# Get PHP extensions installer
COPY --from=mlocati/php-extension-installer /usr/bin/install-php-extensions /usr/local/bin/

# Install PHP extensions
RUN install-php-extensions \
    pdo_mysql \
    gd \
    zip \
    pcntl \
    intl \
    redis \
    opcache

# Get latest Composer
COPY --from=composer:2.5 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www

CMD ["php-fpm", "--nodaemonize"]
