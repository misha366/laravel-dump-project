FROM php:8.2-fpm-alpine
WORKDIR /var/www/laravel
RUN apk add --no-cache mysql-client && \
    apk add --no-cache mariadb-connector-c && \
    docker-php-ext-install pdo pdo_mysql
