FROM php:8.2-fpm-alpine
WORKDIR /var/www/laravel
RUN apk add --no-cache \
    nodejs \
    npm \
    mysql-client \
    mariadb-connector-c && \
    docker-php-ext-install pdo pdo_mysql