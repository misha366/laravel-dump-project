FROM php:8.2-fpm-alpine
ARG WITH_XDEBUG=false
WORKDIR /var/www/laravel
RUN docker-php-ext-install pdo pdo_mysql

RUN if [ "$WITH_XDEBUG" = "true" ]; then \ 
        apk --no-cache add g++ autoconf linux-headers make nodejs npm && \
        pecl install xdebug; \
    else \
        echo "⛔ Xdebug disabled"; \
    fi

COPY xdebug/xdebug.ini /usr/local/etc/php/conf.d/xdebug.ini
