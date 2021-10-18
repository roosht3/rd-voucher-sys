FROM php:8.0-fpm-alpine

WORKDIR /var/www/voucher-instance

RUN php -r "readfile('http://getcomposer.org/installer');" | php -- --install-dir=/usr/bin/ --filename=composer

COPY . .

COPY .env.example .env

RUN composer install

RUN chmod +x run.sh

ENTRYPOINT ["./run.sh"]
