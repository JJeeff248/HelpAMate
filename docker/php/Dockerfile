FROM php:8.4-apache

COPY ./php/src/ /var/www/html/

RUN docker-php-ext-install mysqli && docker-php-ext-enable mysqli \
    && cp "$PHP_INI_DIR/php.ini-production" "$PHP_INI_DIR/php.ini"

COPY ./php/conf.d/app.ini $PHP_INI_DIR/conf.d/app.ini
COPY ./php/apache/zz-hardening.conf /etc/apache2/conf-available/zz-hardening.conf
RUN a2enconf zz-hardening

EXPOSE 80
