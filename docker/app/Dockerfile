FROM php:8.2-fpm-alpine

COPY ./php.ini /usr/local/etc/php/conf.d/php.ini

ENV COMPOSER_ALLOW_SUPERUSER=1

RUN curl -sS https://getcomposer.org/installer | php -- \
    --filename=composer \
    --install-dir=/usr/local/bin

WORKDIR /var/www/aec-test-project

CMD php artisan app:generate-key
CMD chown -R www-data:www-data /var/www/aec-test-project/storage && php-fpm

EXPOSE 9000
