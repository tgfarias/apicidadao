FROM php:7.4.2-apache

ENV AppName Local

RUN apt-get update && apt-get install -y libfreetype6-dev libjpeg62-turbo-dev zlib1g-dev libicu-dev git libzip-dev zip g++ wget gnupg

RUN docker-php-ext-configure intl
RUN docker-php-ext-configure gd --with-freetype=/usr/include/ --with-jpeg=/usr/include/
RUN docker-php-ext-install intl pdo_mysql mysqli gd zip

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN a2enmod rewrite headers

ADD ./api /var/www/html/

RUN composer install --no-dev --prefer-dist --optimize-autoloader && \
    composer clear-cache

WORKDIR /var/www/html/public