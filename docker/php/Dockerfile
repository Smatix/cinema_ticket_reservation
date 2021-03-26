FROM php:7.4-apache

RUN apt-get update && apt-get install -y --no-install-recommends \
    zlib1g-dev \
    libzip-dev \
    zip \
    unzip

RUN docker-php-ext-install \
    pdo_mysql \
    zip \
    && a2enmod rewrite


RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer --version=2.0.4

COPY apache.conf /etc/apache2/sites-enabled/000-default.conf

WORKDIR /var/www/html/cinema_ticket_reservation