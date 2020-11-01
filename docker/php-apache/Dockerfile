FROM php:7.4-apache

COPY php.ini /usr/local/etc/php/php.ini
COPY ssl.conf /etc/apache2/sites-available/ssl.conf

RUN apt update \
    && apt install -y zlib1g-dev libicu-dev g++ libxml2-dev libonig-dev libzip-dev libmcrypt-dev libpq-dev git vim \
    && docker-php-ext-configure intl \
    && docker-php-ext-install intl \
    && docker-php-ext-install simplexml \
    && docker-php-ext-install mbstring \
    && docker-php-ext-install pdo_pgsql \
    && docker-php-ext-install zip \
    && php -r "readfile('http://getcomposer.org/installer');" | php -- --install-dir=/usr/bin/ --filename=composer \
    && pecl install xdebug \
    && docker-php-ext-enable xdebug \
    && apt install -y ssl-cert \
    && make-ssl-cert generate-default-snakeoil \
    && a2enmod ssl \
    && a2enmod rewrite \
    && a2ensite ssl
