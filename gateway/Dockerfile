FROM php:8.0-fpm-alpine

WORKDIR /var/www/gateway-instance

RUN apk add --no-cache pcre-dev $PHPIZE_DEPS \
        && pecl install redis \
        && docker-php-ext-enable redis.so

RUN php -r "readfile('http://getcomposer.org/installer');" | php -- --install-dir=/usr/bin/ --filename=composer

COPY . .
COPY .env.example .env
RUN composer install

RUN chmod +x run.sh
ENTRYPOINT ["./run.sh"]
