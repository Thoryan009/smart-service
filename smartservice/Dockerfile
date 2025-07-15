# Laravel এর জন্য PHP image
FROM php:8.2-fpm

# System dependencies install
RUN apt-get update && apt-get install -y \
    libzip-dev zip unzip curl git \
    && docker-php-ext-install zip pdo pdo_mysql

# Composer install
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Workdir set
WORKDIR /var/www

# Project copy
COPY . .

# Laravel permission fix
RUN chown -R www-data:www-data /var/www \
    && chmod -R 755 /var/www/storage

CMD ["php", "-S", "0.0.0.0:8000", "-t", "public"]
